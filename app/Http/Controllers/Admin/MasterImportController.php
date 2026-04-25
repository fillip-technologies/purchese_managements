<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ClientImport;
use App\Imports\ProductImport;
use App\Imports\UserImport;
use App\Imports\VendorImport;
use App\Imports\VendorProductImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MasterImportController extends Controller
{
    public function index()
    {
        return view('admin.mastersetup.all_import');
    }

    public function allimport(Request $request)
    {
            $request->validate([
                'file' => 'required|file',
                'section' => 'required',
            ]);

            if ($request->section == "user") {
                Excel::import(new UserImport, $request->file('file'));
            } elseif ($request->section == "vendor") {
                Excel::import(new VendorImport, $request->file('file'));
            } elseif ($request->section == "client") {
                Excel::import(new ClientImport, $request->file('file'));
            } elseif ($request->section == "vender_product") {
                Excel::import(new VendorProductImport, $request->file('file'));
            } else {
                Excel::import(new ProductImport, $request->file('file'));
            }

            return back()->with('success', 'Uploaded Data SuccessFul');
        }
}
