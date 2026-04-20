<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::latest()->paginate(10);
        return view('admin.vendors.index', compact('vendors'));
    }

    public function create()
    {
        return view('admin.vendors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'vendor_name' => 'required',
            'phone'       => 'required',
        ]);

        Vendor::create($request->all());

        return redirect()->route('vendors.index')
            ->with('success','Vendor Added Successfully');
    }

    public function show(Vendor $vendor)
    {
        return view('admin.vendors.show', compact('vendor'));
    }

    public function edit(Vendor $vendor)
    {
        return view('admin.vendors.edit', compact('vendor'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'vendor_name' => 'required',
            'phone'       => 'required',
        ]);

        $vendor->update($request->all());

        return redirect()->route('vendors.index')
            ->with('success','Vendor Updated Successfully');
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();

        return redirect()->route('vendors.index')
            ->with('success','Vendor Deleted Successfully');
    }
}
