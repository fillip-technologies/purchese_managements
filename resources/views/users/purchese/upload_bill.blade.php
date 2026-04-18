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
                <h1 class="text-2xl font-bold text-gray-800">Bill Uploads</h1>
                <p class="text-sm text-gray-500">Create and manage material requests</p>
            </div>
        </div>

        <!-- GRID -->
        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- LEFT: FORM -->
            <div class="col-span-1 lg:col-span-2 bg-white p-4 sm:p-6 rounded-2xl shadow-sm border border-gray-100">

                <h2 class="text-lg font-semibold mb-4 text-gray-700">Create Request</h2>

                <form action="{{ route('store.bills') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="uploaded_by" value="{{ Auth::guard('user')->user()->id }}">
                    <!-- Top Fields -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <!-- Purchase Order -->
                        <div>
                            <label class="text-sm text-gray-600">Purchase Order</label>
                            <select name="purchase_order_id"
                                class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                                <option>Select PO</option>
                                @foreach (orderItems() as $op)
                                    <option value="{{ $op->id }}">{{ $op->po_number }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Vendor -->
                        <div>
                            <label class="text-sm text-gray-600">Vendor</label>
                            <select name="vendor_id"
                                class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                                <option>Select Vendor</option>
                                @foreach (AllVendor() as $vender)
                                    <option value="{{ $vender->id }}">{{ $vender->vendor_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Bill No -->
                        <div>
                            <label class="text-sm text-gray-600">Bill No</label>
                            <input type="text" name="bill_no"
                                class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                        </div>

                        <!-- Bill Date -->
                        <div>
                            <label class="text-sm text-gray-600">Bill Date</label>
                            <input type="date" name="bill_date"
                                class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                        </div>

                        <!-- Bill Amount -->
                        <div>
                            <label class="text-sm text-gray-600">Bill Amount</label>
                            <input type="number" step="0.01" name="bill_amount"
                                class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                        </div>

                        <!-- GST -->
                        <div>
                            <label class="text-sm text-gray-600">GST Amount</label>
                            <input type="number" step="0.01" name="gst_amount"
                                class="w-full mt-1 border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                        </div>

                        <!-- Total -->
                        <div>
                            <label class="text-sm text-gray-600">Total Amount</label>
                            <input type="number" step="0.01" name="total_amount"
                                class="w-full mt-1 border rounded-lg p-2">
                        </div>

                        <!-- File Upload -->
                        <div>
                            <label class="text-sm text-gray-600">Upload Bill</label>
                            <input type="file" name="bill_file" class="w-full mt-1 border rounded-lg p-2 bg-white">
                        </div>

                    </div>

                    <!-- Submit -->
                    <div class="mt-6 text-right">
                        <button
                            class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl shadow">
                            Submit Bill
                        </button>
                    </div>
                </form>
            </div>

            <!-- RIGHT: LIST -->
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100">

                <h3 class="font-semibold mb-3 text-gray-700">Bills List</h3>

                <div class="space-y-3">

                    @foreach ($bills ?? [] as $bill)
                        <div class="p-3 border rounded-lg hover:shadow transition bg-white">

                            <!-- Top Row -->
                            <div class="flex items-center justify-between flex-wrap gap-2">

                                <!-- Bill No -->
                                <span class="font-semibold text-gray-800">
                                    {{ $bill->bill_no ?? '' }}
                                </span>

                                <!-- Date -->
                                <span class="text-xs text-gray-500">
                                    {{ date('d M Y', strtotime($bill->bill_date)) ?? '' }}
                                </span>

                                <!-- Amount -->
                                <span class="text-sm font-medium text-green-600">
                                    ₹ {{ number_format($bill->total_amount, 2) ?? '' }}
                                </span>

                                <!-- Actions -->
                                <div class="flex gap-2">

                                    <!-- Preview -->
                                    @if ($bill->bill_file)
                                        <a href="{{ asset($bill->bill_file ?? '') }}" target="_blank"
                                            class="text-xs px-3 py-1 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                                            Preview
                                        </a>
                                    @endif

                                    <!-- Download -->
                                    @if ($bill->bill_file)
                                        <a href="{{ asset('uploads/bills/' . $bill->bill_file ?? '') }}" download
                                            class="text-xs px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                            Download
                                        </a>
                                    @endif

                                </div>

                            </div>

                            <!-- Extra Info -->
                            <div class="text-xs text-gray-500 mt-1">
                                Vendor: {{ $bill->vendor->vendor_name ?? '-' }}
                            </div>

                        </div>
                    @endforeach

                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $bills->links() }}
                </div>

            </div>

        </div>
    </div>
@endsection
