@extends('admin.include.layout')

@section('content')
<div class="max-w-7xl mx-auto p-4">

    <div class="bg-white rounded-2xl shadow border overflow-hidden">

        <!-- HEADER -->
        <div class="p-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 border-b bg-gray-50">
            <h2 class="text-xl font-semibold text-gray-800">Delivery Items</h2>

            <input type="text" placeholder="Search deliveries..."
                class="border rounded-lg px-3 py-2 text-sm w-full sm:w-64 focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>

        <!-- DESKTOP TABLE -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs sticky top-0 ">
                    <tr>
                        <th class="p-3 ">Location</th>
                        <th class="p-3">Receiver</th>
                        <th class="p-3">Date</th>
                        <th class="p-3">Drop</th>
                        <th class="p-3">Photo</th>
                        <th class="p-3">Receipt</th>
                        <th class="p-3">Remarks</th>
                        <th class="p-3">Staff</th>
                        <th class="p-3">Created</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($data as $item)
                        <tr class="border-t hover:bg-gray-50 transition text-center">

                            <td class="p-3 font-medium text-gray-700">
                                {{ ($item->dispatch->purchaseOrder->po_number ?? 'N/A') }}
                                <div class="text-xs text-gray-500">
                                    {{ $item->dispatch->from_location ?? '' }} → {{ $item->dispatch->to_location ?? '' }}
                                </div>
                            </td>

                            <td class="p-3">{{ $item->received_by_name ?? '-' }}</td>

                            <td class="p-3 text-gray-600">
                                {{ $item->received_date ?? '-' }}
                            </td>

                            <td class="p-3 text-center">
                                <span class="px-2 py-1 text-xs bg-blue-100 text-blue-600 rounded-full">
                                    {{ $item->drop_point ?? '-' }}
                                </span>
                            </td>

                            <!-- PHOTO -->
                            <td class="p-3">
                                @if (!empty($item->received_photo))
                                    <img src="{{ asset($item->received_photo) }}"
                                        class="h-10 w-10 rounded-lg object-cover border">
                                @else
                                    <span class="text-gray-400 text-xs">No Image</span>
                                @endif
                            </td>

                            <!-- RECEIPT -->
                            <td class="p-3">
                                @if (!empty($item->receipt_file))
                                    <a href="{{ asset($item->receipt_file) }}" target="_blank"
                                        class="text-blue-500 text-xs font-medium hover:underline">
                                        View File
                                    </a>
                                @else
                                    <span class="text-gray-400 text-xs">N/A</span>
                                @endif
                            </td>

                            <td class="p-3 text-gray-600">
                                {{ $item->remarks ?? '-' }}
                            </td>

                            <td class="p-3">
                                {{ $item->user->full_name ?? '-' }}
                            </td>

                            <td class="p-3 text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center p-6 text-gray-500">
                                No Delivery Records Found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- MOBILE CARD VIEW -->
        <div class="md:hidden p-4 space-y-3">
            @forelse ($data as $item)
                <div class="border rounded-xl p-3 shadow-sm">

                    <div class="flex justify-between items-center">
                        <h3 class="font-semibold text-gray-700 text-sm">
                            {{ $item->dispatch->purchaseOrder->po_number ?? 'N/A' }}
                        </h3>
                        <span class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                        </span>
                    </div>

                    <p class="text-xs text-gray-500 mt-1">
                        {{ $item->dispatch->from_location ?? '' }} → {{ $item->dispatch->to_location ?? '' }}
                    </p>

                    <div class="mt-2 text-sm text-gray-600">
                        <p><strong>Receiver:</strong> {{ $item->received_by_name }}</p>
                        <p><strong>Date:</strong> {{ $item->received_date }}</p>
                        <p><strong>Drop:</strong> {{ $item->drop_point }}</p>
                        <p><strong>Staff:</strong> {{ $item->user->full_name }}</p>
                    </div>

                    <!-- IMAGE + FILE -->
                    <div class="flex justify-between items-center mt-3">
                        <div>
                            @if (!empty($item->received_photo))
                                <img src="{{ asset($item->received_photo) }}"
                                    class="h-10 w-10 rounded-lg object-cover border">
                            @endif
                        </div>

                        <div>
                            @if (!empty($item->receipt_file))
                                <a href="{{ asset($item->receipt_file) }}" target="_blank"
                                    class="text-blue-500 text-xs underline">
                                    Receipt
                                </a>
                            @endif
                        </div>
                    </div>

                    <p class="text-xs text-gray-500 mt-2">
                        {{ $item->remarks ?? '' }}
                    </p>

                </div>
            @empty
                <p class="text-center text-gray-500">No Records Found</p>
            @endforelse
        </div>

    </div>
</div>
@endsection
