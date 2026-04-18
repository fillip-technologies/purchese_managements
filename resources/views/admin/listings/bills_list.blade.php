@extends('admin.include.layout')

@section('content')
    <div class="max-w-7xl mx-auto p-4">

        <div class="bg-white rounded-2xl shadow border overflow-hidden">

            <!-- HEADER -->
            <div class="p-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 border-b">
                <h2 class="text-lg font-bold text-gray-800">Bill Listing</h2>

                <input type="text" placeholder="Search..."
                    class="border rounded-lg px-3 py-2 text-sm w-full sm:w-64 focus:ring-2 focus:ring-blue-400">
            </div>

          <div class="bg-white shadow rounded-2xl p-4">

    <div class="overflow-x-auto table-responsive">
        <table class="w-full border border-gray-200 rounded-lg">
            <thead class="bg-gray-50 text-gray-600 text-xs uppercase">
                <tr>
                    <th class="p-3">#</th>
                    <th class="p-3">Order No</th>
                     <th class="p-3">Bill No</th>
                    <th class="p-3">Vendor</th>
                    <th class="p-3">Staff</th>
                    <th class="p-3">Bill Amount</th>
                     <th class="p-3">Total Amount</th>
                      <th class="p-3">GST Amount</th>
                    <th class="p-3">Date</th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($bills as $key => $bill)
                    <tr class="border-t hover:bg-gray-50 text-center">
                        <td class="p-3">{{ $key + 1 }}</td>


                        <td class="p-3">
                            {{ $bill->purchaseOrder->po_number ?? 'N/A' }}
                        </td>
                        <td class="p-3">
                            {{ $bill->bill_no ?? 'N/A' }}
                        </td>

                        <!-- Vendor -->
                        <td class="p-3">
                            {{ $bill->vendor->vendor_name ?? 'N/A' }}
                        </td>

                        <!-- User -->
                        <td class="p-3">
                            {{ $bill->user->full_name ?? 'N/A' }}
                        </td>

                        <!-- Amount -->
                        <td class="p-3 font-semibold text-green-600">
                            ₹{{ number_format($bill->bill_amount, 2) }}
                        </td>

                         <td class="p-3 font-semibold text-green-600">
                            ₹{{ number_format($bill->total_amount, 2) }}
                        </td>
                         <td class="p-3 font-semibold text-green-600">
                            ₹{{ number_format($bill->gst_amount, 2) }}
                        </td>

                        <!-- Date -->
                        <td class="p-3">
                            {{ $bill->created_at->format('d M Y') }}
                        </td>

                        <!-- Actions -->
                        <td class="p-3 text-center flex gap-1">
                            <a href="{{ asset($bill->bill_file ?? "") }}" target="_blank"
                                class="px-3 py-1 bg-blue-500 text-white rounded-lg text-sm hover:bg-blue-600">
                                View
                            </a>

                            {{-- <a href=""
                                class="px-3 py-1 bg-yellow-500 text-white rounded-lg text-sm hover:bg-yellow-600">
                                Edit
                            </a> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center p-4 text-gray-500">
                            No Bills Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $bills->links() }}
    </div>

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
