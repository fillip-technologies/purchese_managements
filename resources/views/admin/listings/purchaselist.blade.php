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
                                        {{ ucfirst($item['status'] ?? 'pending') }}
                                    </span>

                                </td>

                                <!-- ACTION -->
                                <td class="p-3 text-center">
                                    <form action="{{ route('approve.status',$item['req_id']) }}" method="POST">
                                        @csrf
                                        <div class="flex items-center justify-center gap-2">
                                            <select onchange="this.form.submit()" name="status"
                                                class="text-xs border rounded-lg px-2 py-1 focus:ring-2 focus:ring-blue-400">
                                                <option value="pending">Pending</option>
                                                <option value="approved">Approved</option>
                                                <option value="rejected">Rejected</option>
                                            </select>

                                            <!-- VIEW -->
                                            {{-- <button class="px-2 py-1 text-xs bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                        View
                                    </button>

                                    <!-- DELETE -->
                                    <button class="px-2 py-1 text-xs bg-red-500 text-white rounded-lg hover:bg-red-600">
                                        Delete
                                    </button> --}}

                                        </div>
                                    </form>


                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </div>
@endsection
