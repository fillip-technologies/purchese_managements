<?php

namespace App\Http\Controllers\Admin\Purchese;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Delivery;
use App\Models\Dispatch;
use App\Models\Product;
use App\Models\PurchaseBill;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\PurchaseRequisition;
use App\Models\PurchaseRequisitionItem;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchesManageController extends Controller
{
    public function indexPurcherReq()
    {
        $clients = Client::select('id', 'client_name')->get();
        $products = Product::select('id', 'product_name')->get();
        $users = User::select('id', 'full_name')->where('full_name', '!=', 'Admin')->get();
        $requests = PurchaseRequisition::with(['client', 'user', 'items'])->where('requested_by', Auth::guard('user')->user()->id ?? Auth::guard('admin')->user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('users.purchese.create_purches', compact(
            'clients',
            'products',
            'users',
            'requests'
        ));
    }

    public function storeReq(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'requested_by' => 'required|exists:users,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|numeric|min:1',
        ]);

        DB::beginTransaction();

        try {

            $req_no = 'PR-'.date('Ymd').'-'.rand(100, 999);

            $pr = PurchaseRequisition::create([
                'req_no' => $req_no,
                'client_id' => $request->client_id,
                'project_name' => $request->project_name,
                'requested_by' => $request->requested_by,
                'remarks' => $request->remarks,
                'status' => 'submitted',
            ]);

            foreach ($request->items as $item) {

                PurchaseRequisitionItem::create([
                    'requisition_id' => $pr->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'] ?? null,
                    'remarks' => $item['remarks'] ?? null,
                ]);
            }

            DB::commit();

            return back()->with('success', 'Purchase Requisition Created Successfully');

        } catch (\Exception $e) {

            DB::rollback();

            return back()->with('error', $e->getMessage());
        }
    }

    public function approve(Request $request)
    {
        $id = trim($request->id);
        $pr = PurchaseRequisition::findOrFail($id);

        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $pr->update([
            'status' => $request->status,
        ]);

        if ($request->status === 'approved') {

            $po = PurchaseOrder::create([
                'requisition_id' => $pr->id,
                'po_number' => generatePOnumber(),
                'approved_by' => Auth::guard('admin')->user()->id,
                'status' => 'approved',
                'vendor_id' => $request->vendor_id,
                'subtotal' => 0,
                'client_id' => $pr->client_id,
                'gst_amount' => 0,
                'total_amount' => 0,
            ]);

            $items = PurchaseRequisitionItem::where('requisition_id', $pr->id)->get();

            $subtotal = 0;

            foreach ($items as $item) {

                $lineTotal = $item->quantity * ($item->product->base_price ?? 0);
                $subtotal += $lineTotal;

                PurchaseOrderItem::create([
                    'purchase_order_id' => $po->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->base_price ?? 0,
                    'total' => $lineTotal,
                ]);
            }

            $gst = ($subtotal * 18) / 100;
            $total = $subtotal + $gst;

            $po->update([
                'subtotal' => $subtotal,
                'gst_amount' => $gst,
                'total_amount' => $total,
            ]);
        }

        return back()->with('success', 'Request '.ucfirst($request->status));
    }

    public function listRequisition()
    {
        $data = PurchaseRequisitionItem::with([
            'product',
            'requisition.client',
            'requisition.user',
        ])
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'requisition_no' => $item->requisition->req_no ?? null,
                    'project_name' => $item->requisition->project_name ?? null,
                    'product_name' => $item->product->product_name ?? null,
                    'quantity' => $item->quantity,
                    'unit' => $item->unit,
                    'req_id' => $item->requisition->id,
                    'remarks' => $item->remarks,
                    'status' => $item->requisition->status,
                    'created_at' => $item->created_at?->format('Y-m-d H:i:s'),
                    'client_name' => $item->requisition->client->client_name ?? null,
                    'staff_name' => $item->requisition->user->full_name ?? null,
                ];
            });

        return view('admin.listings.purchaselist', compact('data'));

    }

    public function purchasePdf($id)
    {
        $order = PurchaseOrder::with([
            'requisition',
            'vendor',
            'client',
            'items',
            'approver',
        ])->where('requisition_id', $id)->first();

        return Pdf::loadView('users.purchese.order_list_items', compact('order'))
            ->download('purchase_order_'.$order->po_number.'.pdf');
    }

    public function billUpload()
    {
        $bills = PurchaseBill::orderBy('id', 'desc')->paginate(10);

        return view('users.purchese.upload_bill', compact('bills'));
    }

    public function billedit($id)
    {
        $bills = PurchaseBill::orderBy('id', 'desc')->paginate(10);
        $editbill = PurchaseBill::findOrFail($id);

        return view('users.purchese.upload_bill', compact('bills', 'editbill'));
    }

    public function storeBill(Request $request)
    {
        $request->validate([
            'purchase_order_id' => 'required',
            'vendor_id' => 'required',
            'bill_no' => 'required',
            'bill_date' => 'required|date',
            'bill_amount' => 'required|numeric',
            'gst_amount' => 'nullable|numeric',
            'bill_file' => 'nullable|file|mimes:pdf,jpg,png',
        ]);

        $fileName = null;

        if ($request->hasFile('bill_file')) {
            $file = $request->file('bill_file');
            $fileNameOnly = time().'.'.$file->getClientOriginalExtension();
            $uploadPath = public_path('bills');

            $file->move($uploadPath, $fileNameOnly);

            $fileName = 'bills/'.$fileNameOnly;
        }

        $billAmount = $request->bill_amount;
        $gstPercent = $request->gst_amount ?? 0;

        $gstValue = ($billAmount * $gstPercent) / 100;
        $total = $billAmount + $gstValue;

        PurchaseBill::create([
            'purchase_order_id' => $request->purchase_order_id,
            'vendor_id' => $request->vendor_id,
            'bill_no' => $request->bill_no,
            'uploaded_by' => $request->uploaded_by,
            'bill_date' => $request->bill_date,
            'bill_amount' => $billAmount,
            'gst_amount' => $gstValue,
            'total_amount' => $total,
            'bill_file' => $fileName,
        ]);

        return back()->with('success', 'Bill Added Successfully');
    }

    public function updateBill(Request $request, $id)
    {
        $request->validate([
            'purchase_order_id' => 'required',
            'vendor_id' => 'required',
            'bill_no' => 'required',
            'bill_date' => 'required|date',
            'bill_amount' => 'required|numeric',
            'gst_amount' => 'nullable|numeric',
            'bill_file' => 'nullable|file|mimes:pdf,jpg,png',
        ]);

        $data = PurchaseBill::findOrFail($id);
        $fileName = $data->bill_file;

        if ($request->hasFile('bill_file')) {

            if ($data->bill_file && file_exists(public_path($data->bill_file))) {
                unlink(public_path($data->bill_file));
            }

            $file = $request->file('bill_file');
            $fileNameOnly = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('bills'), $fileNameOnly);

            $fileName = 'bills/'.$fileNameOnly;
        }

        $billAmount = $request->bill_amount;
        $gstPercent = $request->gst_amount ?? 0;

        $gstValue = ($billAmount * $gstPercent) / 100;
        $total = $billAmount + $gstValue;

        $data->update([
            'purchase_order_id' => $request->purchase_order_id,
            'vendor_id' => $request->vendor_id,
            'bill_no' => $request->bill_no,
            'uploaded_by' => $request->uploaded_by,
            'bill_date' => $request->bill_date,
            'bill_amount' => $billAmount,
            'gst_percent' => $gstPercent,
            'gst_amount' => $gstValue,
            'total_amount' => $total,
            'bill_file' => $fileName,
        ]);

        return back()->with('success', 'Bill Updated Successfully');
    }

    public function listingBill()
    {
        $bills = PurchaseBill::with(['purchaseOrder', 'user', 'vendor'])->orderBy('id', 'desc')->paginate(10);

        return view('admin.listings.bills_list', compact('bills'));

    }

    public function billdelete($id)
    {
        PurchaseBill::findOrFail($id)->delete();

        return back()->with('success', 'Bill Deleted SuccessFully');
    }

    public function indexDispatch()
    {
        $dispatches = Dispatch::orderBy('id', 'desc')->paginate(10);

        return view('users.dispatches.add_dispatch', compact('dispatches'));
    }

    public function Dispatchstore(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'dispatch_date' => 'required|date',
            'transport_mode' => 'nullable|string|max:255',
            'vehicle_no' => 'nullable|string|max:255',
            'driver_name' => 'nullable|string|max:255',
            'driver_phone' => 'nullable|string|max:20',
            'from_location' => 'nullable|string|max:255',
            'to_location' => 'nullable|string|max:255',
            'transport_cost' => 'nullable|numeric',
            'remarks' => 'nullable|string',
            'dispatch_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            $fileName = null;
            $data = $request->all();

            if ($request->hasFile('dispatch_photo')) {
                $file = $request->file('dispatch_photo');
                $fileNameOnly = time().'.'.$file->getClientOriginalExtension();
                $uploadPath = public_path('dispatchs');

                $file->move($uploadPath, $fileNameOnly);

                $fileName = 'dispatchs/'.$fileNameOnly;
            }
            $data['dispatch_photo'] = $fileName;
            $data['created_by'] = $request->created_by;

            Dispatch::create($data);

            return redirect()->back()->with('success', 'Dispatch created successfully');

        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Something went wrong!')
                ->withInput();
        }
    }

    public function deletedispatch($id)
    {
        try {
            $id = trim($id);
            Dispatch::findOrFail($id)->delete();

            return redirect()->back()->with('success', 'Dispatch delete successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Worng', $e->getMessage());
        }
    }

    public function editdispatch($id)
    {
        try {
            $id = trim($id);
            $editdata = Dispatch::findOrFail($id);
            $dispatches = Dispatch::orderBy('id', 'desc')->paginate(10);

            return view('users.dispatches.add_dispatch', compact('dispatches', 'editdata'));
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Worng', $e->getMessage());
        }
    }

    public function updatedispach(Request $request, $id)
    {
        $request->validate([
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'dispatch_date' => 'required|date',
            'transport_mode' => 'nullable|string|max:255',
            'vehicle_no' => 'nullable|string|max:255',
            'driver_name' => 'nullable|string|max:255',
            'driver_phone' => 'nullable|string|max:20',
            'from_location' => 'nullable|string|max:255',
            'to_location' => 'nullable|string|max:255',
            'transport_cost' => 'nullable|numeric',
            'remarks' => 'nullable|string',
            'dispatch_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $editdata = Dispatch::findOrFail($id);

        try {
            $fileName = $editdata->dispatch_photo;
            $data = $request->all();

            if ($request->hasFile('dispatch_photo')) {

                if ($editdata->dispatch_photo && file_exists(public_path($editdata->dispatch_photo))) {
                    unlink(public_path($editdata->dispatch_photo));
                }
                $file = $request->file('dispatch_photo');
                $fileNameOnly = time().'.'.$file->getClientOriginalExtension();
                $uploadPath = public_path('dispatchs');

                $file->move($uploadPath, $fileNameOnly);

                $fileName = 'dispatchs/'.$fileNameOnly;
            }
            $data['dispatch_photo'] = $fileName;
            $data['created_by'] = $request->created_by;

            $editdata->update($data);

            return redirect()->back()->with('success', 'Dispatch updated successfully');

        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Something went wrong!')
                ->withInput();
        }
    }

    public function add_Delivery()
    {
        $deliveries = Delivery::where('created_by', Auth::guard('user')->user()->id ?? '')->paginate(2);

        return view('users.dileverys.adddelivery', compact('deliveries'));
    }

    public function store_Delivery(Request $request)
    {
        $request->validate([
            'dispatch_id' => 'required|exists:dispatches,id',
            'received_by_name' => 'nullable|string|max:255',
            'received_date' => 'required|date',
            'drop_point' => 'nullable|string|max:255',
            'received_photo' => 'nullable|file',
            'receipt_file' => 'nullable|file',
            'remarks' => 'nullable|string',
        ]);

        try {
            $receivedPhotoPath = null;
            $receiptFilePath = null;
            $uploadPath = public_path('deliveries');

            if (! file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            if ($request->hasFile('received_photo')) {
                $photo = $request->file('received_photo');
                $photoName = time().'_received_photo.'.$photo->getClientOriginalExtension();
                $photo->move($uploadPath, $photoName);
                $receivedPhotoPath = 'deliveries/'.$photoName;
            }

            if ($request->hasFile('receipt_file')) {
                $receiptFile = $request->file('receipt_file');
                $receiptName = time().'_receipt.'.$receiptFile->getClientOriginalExtension();
                $receiptFile->move($uploadPath, $receiptName);
                $receiptFilePath = 'deliveries/'.$receiptName;
            }

            Delivery::create([
                'dispatch_id' => $request->dispatch_id,
                'received_by_name' => $request->received_by_name,
                'received_date' => $request->received_date,
                'drop_point' => $request->drop_point,
                'created_by' => $request->created_by,
                'received_photo' => $receivedPhotoPath,
                'receipt_file' => $receiptFilePath,
                'remarks' => $request->remarks,
            ]);

            return redirect()->back()->with('success', 'Delivery created successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong!')
                ->withInput();
        }
    }

    public function update_Delivery(Request $request, $id)
    {
        $request->validate([
            'dispatch_id' => 'required|exists:dispatches,id',
            'received_by_name' => 'nullable|string|max:255',
            'received_date' => 'required|date',
            'drop_point' => 'nullable|string|max:255',
            'received_photo' => 'nullable|file',
            'receipt_file' => 'nullable|file',
            'remarks' => 'nullable|string',
        ]);

        $editdata = Delivery::findOrFail($id);

        try {
            $receivedPhotoPath = $editdata->received_photo;
            $receiptFilePath = $editdata->receipt_file;
            $uploadPath = public_path('deliveries');

            if (! file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            if ($request->hasFile('received_photo')) {

                if ($editdata->received_photo && file_exists(public_path($editdata->received_photo))) {
                    unlink(public_path($editdata->received_photo));
                }

                $photo = $request->file('received_photo');
                $photoName = time().'_received_photo.'.$photo->getClientOriginalExtension();
                $photo->move($uploadPath, $photoName);
                $receivedPhotoPath = 'deliveries/'.$photoName;
            }

            if ($request->hasFile('receipt_file')) {

                if ($editdata->receipt_file && file_exists(public_path($editdata->receipt_file))) {
                    unlink(public_path($editdata->receipt_file));
                }

                $receiptFile = $request->file('receipt_file');
                $receiptName = time().'_receipt.'.$receiptFile->getClientOriginalExtension();
                $receiptFile->move($uploadPath, $receiptName);
                $receiptFilePath = 'deliveries/'.$receiptName;
            }

            $editdata->update([
                'dispatch_id' => $request->dispatch_id,
                'received_by_name' => $request->received_by_name,
                'received_date' => $request->received_date,
                'created_by' => $request->created_by,
                'drop_point' => $request->drop_point,
                'received_photo' => $receivedPhotoPath,
                'receipt_file' => $receiptFilePath,
                'remarks' => $request->remarks,
            ]);

            return back()->with('success', 'Updated Delivery Data');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong!')
                ->withInput();
        }
    }

    public function edit_Delivery($id)
    {

        try {

            $editdata = Delivery::findOrFail($id);
            $deliveries = Delivery::where('created_by', Auth::guard('user')->user()->id ?? '')->paginate(2);

            return view('users.dileverys.adddelivery', compact('deliveries', 'editdata'));
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Worng', $e->getMessage());
        }
    }

    public function deletedelivery($id)
    {
        Delivery::findOrFail($id)->delete();
        return back()->with('success', 'Delivery delete successfully');

    }

    public function dsplist() {
        $data = Dispatch::paginate(10);
        return view('admin.listings.dispatchlist',compact('data'));
    }

    public function deliverylist()
    {
        $data = Delivery::with(['dispatch', 'user'])->orderBy('id', 'desc')->get();
        return view('admin.listings.deliverylist', compact('data'));
    }
}
