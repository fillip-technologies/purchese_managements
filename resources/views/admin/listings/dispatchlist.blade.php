@extends('admin.include.layout')

@section('content')
<div class="max-w-7xl mx-auto p-4">

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

        <!-- HEADER -->
        <div class="flex justify-between items-center px-5 py-4 border-b bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                <i class="fas fa-truck text-blue-500"></i>
                Dispatch List
            </h2>
        </div>

        <!-- DESKTOP TABLE -->
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full text-sm">

                <thead class="bg-gray-100 text-gray-600 text-xs uppercase text-center">
                    <tr>
                        <th class="p-3">#</th>
                        <th class="p-3">PO</th>
                        <th class="p-3">Date</th>
                        <th class="p-3">Transport</th>
                        <th class="p-3">Driver</th>
                        <th class="p-3">Route</th>
                        <th class="p-3 text-center">Cost</th>
                        <th class="p-3 text-center">Photo</th>
                        <th class="p-3 text-center">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($data as $key => $item)
                        <tr class="hover:bg-blue-50 transition text-center">

                            <td class="p-3 font-semibold">{{ $key + 1 }}</td>

                            <!-- PO -->
                            <td class="p-3">
                                <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded text-xs font-medium">
                                    {{ $item->purchaseOrder->po_number }}
                                </span>
                            </td>

                            <!-- DATE -->
                            <td class="p-3 text-gray-600">
                                {{ \Carbon\Carbon::parse($item->dispatch_date)->format('d M Y') }}
                            </td>

                            <!-- TRANSPORT -->
                            <td class="p-3">
                                <div class="text-xs bg-gray-200 px-2 py-1 rounded inline-block">
                                    {{ $item->transport_mode }}
                                </div>
                                <div class="text-xs text-gray-500 mt-1">
                                    {{ $item->vehicle_no }}
                                </div>
                            </td>

                            <!-- DRIVER -->
                            <td class="p-3">
                                <div class="font-medium">{{ $item->driver_name }}</div>
                                <div class="text-xs text-gray-400">{{ $item->driver_phone }}</div>
                            </td>

                            <!-- ROUTE -->
                            <td class="p-3 text-xs">
                                <div class="flex flex-col leading-tight">
                                    <span class="text-gray-700">{{ $item->from_location }}</span>
                                    <span class="text-blue-400 text-center">↓</span>
                                    <span class="text-gray-500">{{ $item->to_location }}</span>
                                </div>
                            </td>

                            <!-- COST -->
                            <td class="p-3 text-center">
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs font-semibold">
                                    ₹{{ number_format($item->transport_cost, 2) }}
                                </span>
                            </td>

                            <!-- PHOTO -->
                            <td class="p-3 text-center">
                                @if ($item->dispatch_photo)
                                    <img src="{{ asset($item->dispatch_photo) }}"
                                        class="w-12 h-12 rounded-lg object-cover border shadow-sm mx-auto hover:scale-110 transition cursor-pointer">
                                @else
                                    <span class="text-gray-400 text-xs">No Image</span>
                                @endif
                            </td>

                            <!-- ACTION -->
                            <td class="p-3 text-center">
                                <button onclick="openModal({{ $item->id }})"
                                    class="px-3 py-1.5 text-xs rounded-lg bg-blue-500 text-white hover:bg-blue-600 transition shadow-sm">
                                    Manage
                                </button>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center p-6 text-gray-500">
                                No Dispatch Records Found
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <!-- 📱 MOBILE CARD VIEW -->
        <div class="md:hidden p-4 space-y-3">
            @forelse ($data as $item)
                <div class="border rounded-xl p-3 shadow-sm">

                    <!-- TOP -->
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-semibold text-gray-700">
                            {{ $item->purchaseOrder->po_number }}
                        </span>
                        <span class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($item->dispatch_date)->format('d M Y') }}
                        </span>
                    </div>

                    <!-- ROUTE -->
                    <p class="text-xs text-gray-500 mt-1">
                        {{ $item->from_location }} → {{ $item->to_location }}
                    </p>

                    <!-- DETAILS -->
                    <div class="mt-2 text-sm text-gray-600">
                        <p><strong>Driver:</strong> {{ $item->driver_name }}</p>
                        <p><strong>Vehicle:</strong> {{ $item->vehicle_no }}</p>
                        <p><strong>Mode:</strong> {{ $item->transport_mode }}</p>
                    </div>

                    <!-- COST + IMAGE -->
                    <div class="flex justify-between items-center mt-3">
                        <span class="text-green-600 font-semibold">
                            ₹{{ number_format($item->transport_cost, 2) }}
                        </span>

                        @if ($item->dispatch_photo)
                            <img src="{{ asset($item->dispatch_photo) }}"
                                class="w-10 h-10 rounded-lg object-cover border">
                        @endif
                    </div>

                    <!-- ACTION -->
                    <div class="mt-3 text-right">
                        <button onclick="openModal({{ $item->id }})"
                            class="px-3 py-1 text-xs bg-blue-500 text-white rounded-lg">
                            Manage
                        </button>
                    </div>

                </div>
            @empty
                <p class="text-center text-gray-500">No Records Found</p>
            @endforelse
        </div>

    </div>
</div>
@endsection
