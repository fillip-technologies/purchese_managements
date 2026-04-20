@extends('admin.include.layout')

@section('content')
    {{-- Alerts --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}"
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}"
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: `{!! implode('<br>', $errors->all()) !!}`
            });
        </script>
    @endif

    <div class="max-w-7xl mx-auto px-4 py-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Dispatch Management</h1>
                <p class="text-sm text-gray-500">Create and manage dispatch entries</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- FORM -->
            <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border">

                <h2 class="text-lg font-semibold mb-4 text-gray-700">Create Dispatch</h2>

                <form action="{{ isset($editdata) ? route('dispatch.update', $editdata->id) : route('store.dispatch') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="created_by" value="{{ Auth::guard('user')->user()->id ?? '' }}">

                    <div class="grid grid-cols-2 gap-4">

                        <div>
                            <label class="text-sm">Purchase Order</label>
                            <select name="purchase_order_id" class="w-full border rounded p-2">
                                <option value="">Select PO</option>
                                @foreach (orderItems() as $po)
                                    <option value="{{ $po->id }}" @selected(isset($editdata) ? $editdata->purchase_order_id === $po->id : '')
                                        {{ old('purchase_order_id') == $po->id ? 'selected' : '' }}>
                                        {{ $po->po_number }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date -->
                        <div>
                            <label class="text-sm">Dispatch Date</label>
                            <input type="datetime-local" name="dispatch_date"
                                value="{{ old('dispatch_date', isset($editdata) ? $editdata->dispatch_date : '') }}"
                                class="w-full border rounded p-2">
                        </div>

                        <!-- Mode -->
                        <div>
                            <label class="text-sm">Transport Mode</label>
                            <input type="text" name="transport_mode"
                                value="{{ old('transport_mode', isset($editdata) ? $editdata->transport_mode : '') }}"
                                class="w-full border rounded p-2">
                        </div>

                        <!-- Vehicle -->
                        <div>
                            <label class="text-sm">Vehicle No</label>
                            <input type="text" name="vehicle_no"
                                value="{{ old('vehicle_no', isset($editdata) ? $editdata->vehicle_no : '') }}"
                                class="w-full border rounded p-2">
                        </div>

                        <!-- Driver -->
                        <div>
                            <label class="text-sm">Driver Name</label>
                            <input type="text" name="driver_name"
                                value="{{ old('driver_name', isset($editdata) ? $editdata->driver_name : '') }}"
                                class="w-full border rounded p-2">
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="text-sm">Driver Phone</label>
                            <input type="text" name="driver_phone"
                                value="{{ old('driver_phone', isset($editdata) ? $editdata->driver_phone : '') }}"
                                class="w-full border rounded p-2">
                        </div>

                        <!-- From -->
                        <div>
                            <label class="text-sm">From Location</label>
                            <input type="text" name="from_location"
                                value="{{ old('from_location', isset($editdata) ? $editdata->from_location : '') }}"
                                class="w-full border rounded p-2">
                        </div>

                        <!-- To -->
                        <div>
                            <label class="text-sm">To Location</label>
                            <input type="text" name="to_location"
                                value="{{ old('to_location', isset($editdata) ? $editdata->to_location : '') }}"
                                class="w-full border rounded p-2">
                        </div>

                        <!-- Cost -->
                        <div>
                            <label class="text-sm">Transport Cost</label>
                            <input type="number" step="0.01" name="transport_cost"
                                value="{{ old('transport_cost', isset($editdata) ? $editdata->transport_cost : '') }}"
                                class="w-full border rounded p-2">
                        </div>

                        <!-- Photo -->
                        <div>
                            <label class="text-sm">Dispatch Photo</label>
                            <input type="file" name="dispatch_photo" class="w-full border rounded p-2">
                            <div>
                                <img src="{{ asset(isset($editdata) ? $editdata->dispatch_photo : '') }}" alt=""
                                    width="100px">
                            </div>
                        </div>

                        <!-- Remarks -->
                        <div class="col-span-2">
                            <label class="text-sm">Remarks</label>
                            <textarea name="remarks" rows="3" class="w-full border rounded p-2">{{ old('remarks', isset($editdata) ? $editdata->remarks : '') }}</textarea>
                        </div>

                    </div>

                    <div class="text-end">
                        <button type="submit" class="mt-4 bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                            {{ !empty($editdata) ? 'Updated' : 'Save' }}
                        </button>
                        @if (!empty($editdata))
                            <a href="{{ route('dispatch.index') }}"
                                class="mt-4 bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-700">
                                Back
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- LIST -->
            <div class="bg-white p-4 rounded-2xl shadow-sm border">

                <h3 class="font-semibold mb-3 text-gray-700">Recent Dispatch</h3>

                @forelse ($dispatches as $dispatch)
                    <div class="p-3 border rounded-lg mb-3 hover:shadow">

                        <div class="flex justify-between items-center">

                            <!-- Left -->
                            <div>
                                <span class="font-semibold">
                                    PO: {{ $dispatch->purchaseOrder->po_number ?? 'N/A' }}
                                </span>

                                <div class="text-xs text-gray-500 mt-1">
                                    {{ $dispatch->from_location }} → {{ $dispatch->to_location }}
                                </div>

                                <div class="text-xs mt-1">
                                    {{ $dispatch->transport_mode }} | {{ $dispatch->vehicle_no }} |  <span><a href="" class="text-blue-500 :hover">View</a></span>
                                </div>
                            </div>

                            <!-- Right -->
                            <div class="text-right">

                                <span class="text-xs text-gray-500 block mb-2">
                                    {{ \Carbon\Carbon::parse($dispatch->dispatch_date)->format('d M Y') }}
                                </span>

                                <div class="flex gap-2 justify-end">

                                    <!-- ✏️ Edit -->
                                    <a href="{{ route('edit.dispatche', $dispatch->id) }}"
                                        class="text-xs px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500">
                                        Edit
                                    </a>

                                    <!-- 🗑 Delete -->
                                    <form action="{{ route('delete.dispatch', $dispatch->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure to delete?')">
                                        <input type="hidden" name="created_by"
                                            value="{{ Auth::guard('user')->user()->id ?? '' }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-xs px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                            Delete
                                        </button>
                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>
                @empty
                    <p class="text-sm text-gray-500">No dispatch records found</p>
                @endforelse

                <div class="mt-4">
                    {{ $dispatches->links() }}
                </div>

            </div>

        </div>
    </div>
@endsection
