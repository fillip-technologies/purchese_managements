@extends('admin.include.layout')

@section('content')
    <div class="max-w-7xl mx-auto p-4">

        <div class="bg-white rounded-2xl shadow border overflow-hidden">

            <!-- HEADER -->
            <div class="p-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 border-b">
                <h2 class="text-lg font-bold text-gray-800">Purchase Requisition Items</h2>

                <input type="text" placeholder="Search..."
                    class="border rounded-lg px-3 py-2 text-sm w-full sm:w-64 focus:ring-2 focus:ring-blue-400">
            </div>
            <!-- MODAL -->
            <div id="actionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">

                <div class="bg-white w-full max-w-md rounded-lg p-5 shadow-lg">

                    <h2 class="text-lg font-semibold mb-4">Take Action</h2>

                    <form method="POST" action="{{ route('approve.status') }}">
                        @csrf

                        <input type="hidden" name="id" id="req_id">

                        <label class="block text-sm mb-1">Status</label>
                        <select name="status" class="w-full border p-2 rounded mb-3">
                            <option value="approved">Approve</option>
                            <option value="rejected">Reject</option>
                        </select>

                        <label class="block text-sm mb-1">All Vendor</label>
                        <select name="vendor_id" class="w-full border p-2 rounded mb-3">
                            <option value="approved">Select Vendor</option>
                            @foreach (AllVendor() as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->vendor_name }}</option>
                            @endforeach

                        </select>

                        <div class="flex justify-end gap-2">
                            <button type="button" onclick="closeModal()" class="px-3 py-1 bg-gray-300 rounded">
                                Cancel
                            </button>

                            <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded">
                                Submit
                            </button>
                        </div>

                    </form>

                </div>
            </div>
            <!-- TABLE -->
            <div class="overflow-x-auto">

                <table class="min-w-full text-sm">

                    <thead class="bg-gray-50 text-gray-600 text-xs uppercase">
                        <tr>
                            <th class="p-3 text-left">Req No</th>
                            <th class="p-3 text-left">Project</th>
                            <th class="p-3 text-left">Product</th>
                            <th class="p-3 text-center">Qty</th>
                            <th class="p-3 text-left">Client</th>
                            <th class="p-3 text-left">Staff</th>
                            <th class="p-3 text-center">Status</th>
                            <th class="p-3 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @foreach ($data as $item)
                            <tr class="hover:bg-gray-50 transition">

                                <!-- Req No -->
                                <td class="p-3 font-medium text-gray-700">
                                    {{ $item['requisition_no'] }}
                                </td>

                                <!-- Project -->
                                <td class="p-3 text-gray-600">
                                    {{ $item['project_name'] }}
                                </td>

                                <!-- Product -->
                                <td class="p-3 text-gray-600">
                                    {{ $item['product_name'] }}
                                </td>

                                <!-- Qty -->
                                <td class="p-3 text-center">
                                    <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs">
                                        {{ $item['quantity'] }} {{ $item['unit'] }}
                                    </span>
                                </td>

                                <!-- Client -->
                                <td class="p-3 text-gray-600">
                                    {{ $item['client_name'] }}
                                </td>

                                <!-- Staff -->
                                <td class="p-3 text-gray-600">
                                    {{ $item['staff_name'] }}
                                </td>

                                <!-- STATUS -->
                                <td class="p-3 text-center">

                                    <span
                                        class="px-2 py-1 text-xs rounded-lg
        @if ($item['status'] === 'submitted') bg-yellow-100 text-yellow-700
        @elseif($item['status'] === 'approved')
            bg-green-100 text-green-700
        @elseif($item['status'] === 'rejected')
            bg-red-100 text-red-700
        @else
            bg-gray-100 text-gray-600 @endif
    ">



                                        {{ ucfirst($item['status'] ?? 'draft') }}

                                    </span>

                                </td>


                                <td class="p-3 text-center">
                                    <button class="bg-blue-500 hover:bg-blue-600 text-white p-1 rounded"
                                        onclick="openModal({{ $item['req_id'] }})">
                                        Take Action
                                    </button>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById('actionModal').classList.remove('hidden');
            document.getElementById('actionModal').classList.add('flex');

            document.getElementById('req_id').value = id;
        }

        function closeModal() {
            document.getElementById('actionModal').classList.add('hidden');
            document.getElementById('actionModal').classList.remove('flex');
        }
    </script>
@endsection
