@extends('admin.include.layout')

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                confirmButtonColor: '#3085d6'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                confirmButtonColor: '#d33'
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#d33'
            });
        </script>
    @endif

    <div class="max-w-7xl mx-auto px-4 py-6">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-6 gap-2">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Purchase Requisition</h1>
                <p class="text-sm text-gray-500">Create and manage material requests</p>
            </div>
        </div>

        <!-- GRID -->
        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- LEFT: FORM -->
            <div class="col-span-1 lg:col-span-2 bg-white p-4 sm:p-6 rounded-2xl shadow-sm border border-gray-100">

                <h2 class="text-lg font-semibold mb-4 text-gray-700">Create Request</h2>

                <form action="{{ route('store.purches') }}" method="POST">
                    @csrf

                    <!-- Top Fields -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <div>
                            <label class="text-sm text-gray-600">Req No</label>
                            <input type="text" name="req_no" value="{{ req_no() }}" readonly
                                class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Client</label>
                            <select name="client_id"
                                class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                                <option>Select Client</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Project</label>
                            <input type="text" name="project_name" class="w-full mt-1 border rounded-lg p-2">
                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Requested By</label>

                            <input type="hidden" name="requested_by" value="{{ Auth::guard('user')->id() }}">

                            <select class="w-full mt-1 border rounded-lg p-2 bg-gray-100 cursor-not-allowed" disabled>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ Auth::guard('user')->id() == $user->id ? 'selected' : '' }}>
                                        {{ $user->full_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <!-- Remarks -->
                    <div class="mt-4">
                        <label class="text-sm text-gray-600">Remarks</label>
                        <textarea name="remarks" class="w-full mt-1 border rounded-lg p-2" rows="2"></textarea>
                    </div>

                    <!-- Items -->
                    <div class="mt-6">
                        <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-2 mb-2">
                            <h3 class="font-semibold text-gray-700">Items</h3>
                            <button type="button" onclick="addRow()"
                                class="w-full sm:w-auto bg-blue-500 text-white px-3 py-1 rounded-lg text-sm shadow">
                                + Add Item
                            </button>
                        </div>

                        <div class="overflow-x-auto border rounded-xl">
                            <table class="min-w-[600px] w-full text-sm">
                                <thead class="bg-gray-50 text-gray-600">
                                    <tr>
                                        <th class="p-2 text-left">Product</th>
                                        <th class="p-2">Qty</th>
                                        <th class="p-2">Unit</th>
                                        <th class="p-2">Remarks</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody id="itemsTable">

                                    <tr class="border-t">
                                        <td class="p-2">
                                            <select name="items[0][product_id]" class="w-full border rounded p-2">
                                                <option>Select</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->product_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td class="p-2">
                                            <input type="number" name="items[0][quantity]"
                                                class="w-full border rounded p-2">
                                        </td>

                                        <td class="p-2">
                                            <input type="text" name="items[0][unit]" class="w-full border rounded p-2">
                                        </td>

                                        <td class="p-2">
                                            <input type="text" name="items[0][remarks]"
                                                class="w-full border rounded p-2">
                                        </td>

                                        <td class="p-2 text-center">
                                            <button type="button" onclick="removeRow(this)" class="text-red-500">✕</button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="mt-6 text-right">
                        <button
                            class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl shadow">
                            Submit Request
                        </button>
                    </div>

                </form>
            </div>

            <!-- RIGHT: LIST -->
            <div class="bg-white p-4 sm:p-4 rounded-2xl shadow-sm border border-gray-100">

                <h3 class="font-semibold mb-3 text-gray-700">Recent Requests</h3>

                <div class="space-y-3">

                    @foreach ($requests as $req)
                        <div class="p-3 border rounded-lg hover:shadow transition">

                            <div
                                class="flex items-center justify-between p-3 bg-white rounded-lg border hover:shadow-sm transition">

                                <!-- Requisition No -->
                                <span class="font-semibold text-gray-800">
                                    {{ $req->req_no }}
                                </span>

                                <!-- Status -->
                                <span
                                    class="text-xs px-3 py-1 rounded-full font-medium
        @if ($req->status == 'approved') bg-green-100 text-green-700
        @elseif($req->status == 'rejected') bg-red-100 text-red-700
        @else bg-yellow-100 text-yellow-700 @endif">

                                    {{ ucfirst($req->status) }}
                                </span>

                                <!-- Action -->
                                <div class="flex items-center gap-2 @if($req->status != 'approved') hidden @endif">

                                    @if ($req->status === 'approved')
                                        <a href=""
                                            class="text-xs px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                                            Download
                                        </a>
                                    @endif

                                </div>

                            </div>

                            <div class="text-xs text-gray-500 mt-1">
                                {{ $req->project_name }}
                            </div>

                        </div>
                    @endforeach

                </div>

                <div class="mt-4">
                    {{ $requests->links() }}
                </div>

            </div>

        </div>
    </div>

    <script>
        let index = 1;

        function addRow() {
            let html = `
    <tr class="border-t">
        <td class="p-2">
            <select name="items[${index}][product_id]" class="w-full border rounded p-2">
                <option>Select</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                @endforeach
            </select>
        </td>
        <td class="p-2"><input type="number" name="items[${index}][quantity]" class="w-full border rounded p-2"></td>
        <td class="p-2"><input type="text" name="items[${index}][unit]" class="w-full border rounded p-2"></td>
        <td class="p-2"><input type="text" name="items[${index}][remarks]" class="w-full border rounded p-2"></td>
        <td class="p-2 text-center"><button onclick="removeRow(this)" class="text-red-500">✕</button></td>
    </tr>`;

            document.getElementById('itemsTable').insertAdjacentHTML('beforeend', html);
            index++;
        }

        function removeRow(btn) {
            btn.closest('tr').remove();
        }
    </script>
@endsection
