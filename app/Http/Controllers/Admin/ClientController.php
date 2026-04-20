<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->paginate(10);
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required',
            'phone' => 'required',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('success', 'Client Added Successfully');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'client_name' => 'required',
            'phone' => 'required',
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Client Updated Successfully');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client Deleted Successfully');
    }

    public function show($id)
{
    $client = Client::findOrFail($id);
    return view('admin.clients.show', compact('client'));
}
}
