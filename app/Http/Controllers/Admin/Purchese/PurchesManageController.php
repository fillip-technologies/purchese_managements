<?php

namespace App\Http\Controllers\Admin\Purchese;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\PurchaseRequisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchesManageController extends Controller
{
    public function indexPurcherReq()
    {
        $clients = Client::select('id', 'client_name')->get();

        return view('users.purchese.create_purches', compact('clients'));
    }

    public function storeReq(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'client_id' => 'nullable|exists:clients,id',
            'remarks' => 'nullable|string',
            'status' => 'required|in:draft,submitted,approved,rejected',
        ]);

        PurchaseRequisition::create([
            'project_name' => $request->project_name,
            'client_id' => $request->client_id,
            'requested_by' => Auth::guard('user')->user()->id ?? Auth::guard('admin')->user()->id,
            'remarks' => $request->remarks,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Request added successfully');
    }
}
