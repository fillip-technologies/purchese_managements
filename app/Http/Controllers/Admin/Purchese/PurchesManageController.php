<?php

namespace App\Http\Controllers\Admin\Purchese;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\PurchaseRequisition;
use App\Models\PurchaseRequisitionItem;
use App\Models\User;
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
        $requests = PurchaseRequisition::with(['client', 'user'])->where('requested_by', Auth::guard('user')->user()->id ?? Auth::guard('admin')->user()->id)
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
                'po_number'=> generatePOnumber(),
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

    public function purchasepfd() {}
}
