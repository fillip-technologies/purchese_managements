@if (session('success'))
    <div x-data="{ show: true }" x-show="show"
        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        {{ session('success') }}
        <span @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
            &times;
        </span>
    </div>
@endif

@if (session('added'))
    <div x-data="{ show: true }" x-show="show"
        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        {{ session('added') }}
        <span @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
            &times;
        </span>
    </div>
@endif
<section class="bg-white py-16" x-data="cart()" x-init="init()">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <!-- Heading -->
        <h2 class="text-2xl text-primary mb-10">Your Shopping Cart</h2>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            <!-- Cart Items -->
            <div class="lg:col-span-2 space-y-8">
                @if ($cartdatas->count() > 0)
                    @foreach ($cartdatas as $data)
                        <div
                            class="flex flex-col sm:flex-row items-center sm:items-start gap-6 border px-4 py-3 pb-6 rounded-lg shadow-sm">

                            <img src="{{ asset(optional($data->product)->image ?? 'images/no-image.png') }}"
                                alt="Product Image" class="w-28 h-28 object-contain mx-auto sm:mx-0" />

                            <div class="flex-1 text-center sm:text-left">
                                <h3 class="text-lg font-medium text-gray-800">{{ optional($data->product)->name }}</h3>
                                <p class="text-sm text-gray-500 mt-1">SKU: {{ optional($data->product)->sku }}</p>
                                <p class="mt-2 text-secondary font-semibold">
                                    ₹{{ number_format(optional($data->product)->price, 2) }}
                                </p>

                                <!-- Quantity -->
                                <div class="mt-3 flex justify-center sm:justify-start items-center gap-3">
                                    <span class="text-sm text-gray-700">Qty:</span>
                                    <div class="flex items-center border rounded">
                                        <button @click="decreaseQty({{ $data->id }})"
                                            class="px-3 py-1 text-gray-600 hover:bg-pink-50">-</button>
                                        <input type="number" min="1"
                                            x-model.number="quantities[{{ $data->id }}]"
                                            @change="updateQty({{ $data->id }}, {{ optional($data->product)->price ?? 0 }})"
                                            class="w-12 text-center border-x text-gray-800" />
                                        <button
                                            @click="increaseQty({{ $data->id }}, {{ optional($data->product)->price ?? 0 }})"
                                            class="px-3 py-1 text-gray-600 hover:bg-pink-50">+</button>
                                    </div>
                                </div>
                            </div>

                            <div class="flex sm:flex-col items-center sm:items-end justify-center gap-3 mt-4 sm:mt-0">
                                <form action="{{ route('store.wishlist') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ Auth::check() ? Auth::user()->id : 0 }}"
                                        name="user_id">
                                    <input type="hidden" value="{{ optional($data->product)->id }}" name="product_id">
                                    <button type="submit"
                                        class="text-gray-500 hover:text-primary text-sm flex items-center gap-1">
                                        <i class="fa-regular fa-heart"></i> Wishlist
                                    </button>
                                </form>

                                <form action="{{ route('cart.delete', $data->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-secondary hover:underline text-sm flex items-center gap-1">
                                        <i class="fa-solid fa-trash"></i> Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h3
                        class="text-xl font-semibold text-secondary mb-6 text-center hover:shadow-md py-3 rounded-md duration-2000 transition">
                        No Cart Items
                    </h3>
                @endif
            </div>
            <div
                class="bg-primary border-2 border-secondary rounded p-6 shadow-sm lg:sticky lg:top-6 self-start text-white">
                <h3 class="text-xl font-semibold text-secondary mb-6">Order Summary</h3>

                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt>Subtotal</dt>
                        <dd>₹<span x-text="subtotal.toLocaleString()"></span></dd>
                    </div>
                    <div class="flex justify-between">
                        <dt>Shipping</dt>
                        <dd>₹<span x-text="shipping.toLocaleString()"></span></dd>
                    </div>
                    <div class="flex justify-between">
                        <dt>Tax</dt>
                        <dd>₹<span x-text="tax.toLocaleString()"></span></dd>
                    </div>
                    <div class="flex justify-between font-semibold border-t pt-3 text-white">
                        <dt>Total</dt>
                        <dd>₹<span x-text="total.toLocaleString()"></span></dd>
                    </div>
                </dl>

                <a href="{{ route('checkout') }}"
                    class="block w-full mt-6 bg-secondary text-primary py-3 rounded shadow-md hover:bg-secondary/90 transition font-medium text-center">
                    Proceed to Checkout <i class="fa-solid fa-lock ml-2"></i>
                </a>

                <a href="/view-product" class="block mt-4 text-center text-sm text-secondary hover:underline">
                    <i class="fa-solid fa-arrow-left"></i> Continue Shopping
                </a>

                <div class="mt-4">
                    <p class="text-xs text-gray-300 text-center mb-2">We accept</p>
                    <div class="flex justify-center space-x-2">
                        <i class="fab fa-cc-visa text-blue-400 text-2xl"></i>
                        <i class="fab fa-cc-mastercard text-red-400 text-2xl"></i>
                        <i class="fab fa-cc-amex text-blue-300 text-2xl"></i>
                        <i class="fab fa-cc-paypal text-blue-500 text-2xl"></i>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <p class="text-xs text-gray-300">
                        <i class="fas fa-shield-alt mr-1"></i>
                        Secure checkout with SSL encryption
                    </p>
                </div>
            </div>
        </div>
    </div>


    <script>
        function cart() {
            return {
                quantities: {},
                subtotal: 0,
                shipping: 50,
                tax: 0,
                total: 0,

                init() {
                    // initialize quantities from Blade
                    @foreach ($cartdatas as $data)
                        this.quantities[{{ $data->id }}] = {{ $data->quantity }};
                    @endforeach

                    this.calculateTotals();
                },

                increaseQty(id, price) {
                    this.quantities[id]++;
                    this.calculateTotals();
                },

                decreaseQty(id) {
                    if (this.quantities[id] > 1) {
                        this.quantities[id]--;
                        this.calculateTotals();
                    }
                },

                updateQty(id, price) {
                    if (this.quantities[id] < 1) this.quantities[id] = 1;
                    this.calculateTotals();
                },

                calculateTotals() {
                    this.subtotal = 0;

                    @foreach ($cartdatas as $data)
                        let id = {{ $data->id }};
                        let price = {{ optional($data->product)->price ?? 0 }};
                        this.subtotal += (this.quantities[id] || 1) * price;
                    @endforeach

                    this.tax = this.subtotal * 0.05; // 5% tax
                    this.total = this.subtotal + this.shipping + this.tax;
                }
            }
        }
    </script>
</section>
