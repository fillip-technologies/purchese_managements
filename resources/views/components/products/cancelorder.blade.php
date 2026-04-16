<section id="cancelOrderSection" class="bg-gray-50 py-12 px-4 min-h-screen" x-data="{ openModal: false, selectedOrder: null }">
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold text-primary">Cancel Orders</h2>
        </div>

        <!-- Table Container -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto w-full">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-6 py-4 text-left font-medium whitespace-nowrap">Order ID</th>
                            <th class="px-6 py-4 text-left font-medium whitespace-nowrap">Product</th>
                            <th class="px-6 py-4 text-left font-medium whitespace-nowrap">Date</th>
                            <th class="px-6 py-4 text-left font-medium whitespace-nowrap">Status</th>
                            <th class="px-6 py-4 text-right font-medium whitespace-nowrap">Amount</th>
                            <th class="px-6 py-4 text-right font-medium whitespace-nowrap"></th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @foreach ($productdatas as $product)
                            @php
                                $cancel = $cancelorder->firstWhere('product_id', $product->id);
                            @endphp
                            <tr class="hover:bg-gray-50 transition-all">
                                <td class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap">
                                    #{{ $product->id }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $product->name }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $product->created_at->format('M d, Y') }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($cancel)
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                            Cancelled
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                            Active
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right font-semibold whitespace-nowrap">
                                    ₹{{ number_format($product->price, 2) }}
                                </td>

                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    @if (!$cancel)
                                        <button
                                            @click="openModal = true; selectedOrder = {{ $product->id }}"
                                            class="text-sm bg-red-100 text-red-600 px-3 py-1 rounded-full hover:bg-red-200 transition">
                                            Cancel Order
                                        </button>
                                    @else
                                        <span class="text-sm text-gray-500">Already Cancelled</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Info Note -->
        <div class="mt-6 text-center text-gray-500 text-sm">
            <p>Orders once shipped may not be cancellable. Please contact support for assistance.</p>
        </div>
    </div>

    <!-- Modal -->
    <div
        x-show="openModal"
        x-cloak
        class="fixed inset-0 flex items-center justify-center bg-black/50 z-50"
    >
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
            <button @click="openModal = false" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                ✕
            </button>

            <h3 class="text-xl font-semibold mb-4 text-primary">Cancel Order</h3>

        </div>
    </div>
</section>
