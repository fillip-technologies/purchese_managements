@extends('admin.include.layout')

@section('content')
<div class="max-w-7xl mx-auto p-4">

    <div class="bg-white rounded-2xl shadow border overflow-hidden">

        <!-- HEADER -->
        <div class="p-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 border-b bg-gray-50">
            <h2 class="text-xl font-semibold text-gray-800">Bill Listing</h2>

            <div class="flex gap-2 w-full sm:w-auto">
                <input type="text" placeholder="Search bills..."
                    class="border rounded-lg px-3 py-2 text-sm w-full sm:w-64 focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>
        </div>

        <!-- TABLE (Desktop) -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs sticky top-0">
                    <tr>
                        <th class="p-3">#</th>
                        <th class="p-3">Order</th>
                        <th class="p-3">Bill</th>
                        <th class="p-3">Vendor</th>
                        <th class="p-3">Staff</th>
                        <th class="p-3">Amount</th>
                        <th class="p-3">GST</th>
                        <th class="p-3">Total</th>
                        <th class="p-3">Date</th>
                        <th class="p-3 text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($bills as $key => $bill)
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="p-3">{{ $key + 1 }}</td>

                            <td class="p-3 font-medium">
                                {{ $bill->purchaseOrder->po_number ?? '-' }}
                            </td>

                            <td class="p-3">
                                {{ $bill->bill_no ?? '-' }}
                            </td>

                            <td class="p-3">
                                {{ $bill->vendor->vendor_name ?? '-' }}
                            </td>

                            <td class="p-3">
                                {{ $bill->user->full_name ?? '-' }}
                            </td>

                            <td class="p-3 font-semibold text-blue-600">
                                ₹{{ number_format($bill->bill_amount, 2) }}
                            </td>

                            <td class="p-3 text-yellow-600 font-medium">
                                ₹{{ number_format($bill->gst_amount, 2) }}
                            </td>

                            <td class="p-3 font-bold text-green-600">
                                ₹{{ number_format($bill->total_amount, 2) }}
                            </td>

                            <td class="p-3">
                                {{ $bill->created_at->format('d M Y') }}
                            </td>

                            <td class="p-3 text-center">
                                <a href="{{ asset($bill->bill_file ?? '') }}" target="_blank"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-500 text-white rounded-lg text-xs hover:bg-blue-600 transition">
                                    👁 View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center p-6 text-gray-500">
                                No Bills Found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- MOBILE VIEW (Cards) -->
        <div class="md:hidden p-4 space-y-3">
            @forelse ($bills as $bill)
                <div class="border rounded-xl p-3 shadow-sm">

                    <div class="flex justify-between items-center mb-2">
                        <span class="font-semibold text-gray-700">
                            {{ $bill->purchaseOrder->po_number ?? '-' }}
                        </span>
                        <span class="text-xs text-gray-500">
                            {{ $bill->created_at->format('d M Y') }}
                        </span>
                    </div>

                    <p class="text-sm text-gray-600">Bill: {{ $bill->bill_no }}</p>
                    <p class="text-sm text-gray-600">Vendor: {{ $bill->vendor->vendor_name }}</p>
                    <p class="text-sm text-gray-600">Staff: {{ $bill->user->full_name }}</p>

                    <div class="flex justify-between mt-2 text-sm">
                        <span class="text-blue-600 font-medium">
                            ₹{{ number_format($bill->bill_amount, 2) }}
                        </span>
                        <span class="text-yellow-600">
                            GST: ₹{{ number_format($bill->gst_amount, 2) }}
                        </span>
                        <span class="text-green-600 font-semibold">
                            ₹{{ number_format($bill->total_amount, 2) }}
                        </span>
                    </div>

                    <div class="mt-3 text-right">
                        <a href="{{ asset($bill->bill_file ?? '') }}" target="_blank"
                            class="px-3 py-1.5 bg-blue-500 text-white rounded-lg text-xs hover:bg-blue-600">
                            View
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">No Bills Found</p>
            @endforelse
        </div>

        <!-- PAGINATION -->
        <div class="p-4 border-t">
            {{ $bills->links() }}
        </div>

    </div>
</div>
@endsection
