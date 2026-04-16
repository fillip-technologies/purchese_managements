@php
    $galleryImages = [];
    if (!empty($productdetails->gallery_images)) {
        $decoded = json_decode($productdetails->gallery_images, true);
        if (is_array($decoded)) {
            $galleryImages = $decoded;
        }
    }
    $images = $galleryImages;
@endphp

<section class="relative bg-white py-12">
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <div class="flex flex-col justify-start md:sticky md:top-20 md:pl-10">
                <!-- Wishlist & Share Buttons -->
                <div class="flex items-center justify-start gap-6 md:px-4">

                    <form action="{{ route('store.wishlist') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::check() ? Auth::user()->id : '' }}">
                        <input type="hidden" name="product_id" value="{{ $productdetails->id }}">
                        <button type="submit" class="flex items-center gap-2 text-gray-600 hover:text-primary">
                            <i class="fa-regular fa-heart"></i> Add to Wishlist
                        </button>
                    </form>

                    <button class="flex items-center gap-2 text-gray-600 hover:text-primary">
                        <i class="fa-solid fa-share-nodes"></i> Share
                    </button>
                </div>

                <div class="md:sticky md:top-24 w-full">
                    <section x-data="galleryComponent({{ json_encode($images) }})" class="w-full py-4 md:px-4">
                        <div class="grid grid-cols-1 gap-4">

                            <div class="relative overflow-hidden rounded group cursor-pointer aspect-video w-full">
                                <!-- ✅ Updated: use currentImage dynamically -->
                                <img :src="currentImage"
                                    class="absolute top-0 left-0 w-full h-full object-cover transition-all duration-500 rounded" />
                                <button @click.stop="prev()"
                                    class="md:hidden absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white rounded-full w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center z-10">
                                    <i class="fa-solid fa-chevron-left text-xs sm:text-base"></i>
                                </button>
                                <button @click.stop="next()"
                                    class="md:hidden absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white rounded-full w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center z-10">
                                    <i class="fa-solid fa-chevron-right text-xs sm:text-base"></i>
                                </button>
                            </div>
                            <div class="md:flex flex-wrap justify-center gap-4 hidden">
                                <template x-for="(img, index) in images" :key="index">
                                    <div @click="select(index)" class="overflow-hidden rounded cursor-pointer border-2"
                                        :class="currentIndex === index ? 'border-secondary' : 'border-transparent'">
                                        <img :src="img" class="w-20 h-20 object-cover rounded" />
                                    </div>
                                </template>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <div class="flex items-center px-4">
                <div class="max-w-xl">

                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-2">
                        <div class="flex items-center">
                            <p class="uppercase tracking-wide text-primary">Premium Gifts / Luxury Gift Hampers</p>
                        </div>
                        <div class="flex items-center space-x-1">
                            <span class="text-primary">★★★★★</span>
                            <span class="text-sm text-gray-500">(5 Star)</span>
                        </div>
                    </div>

                    <h2 class="font-serif text-3xl md:text-4xl font-semibold text-secondary mb-2">
                        {{ $productdetails->name }}
                    </h2>

                    <div class="flex items-center justify-between mb-3">
                        <!-- SKU with copy -->
                        <div class="flex items-center space-x-2">
                            <span id="sku" class="text-sm text-gray-500">SKU: {{ $productdetails->sku }}</span>
                            <button onclick="copySKU()" class="text-primary hover:text-primary transition-colors">
                                <i class="fa-regular fa-copy"></i>
                            </button>
                        </div>

                        <!-- Stock Status -->
                        <span class="text-sm text-green-600 font-medium">
                            {{ optional($productdetails->variants->first())->stock ?? '0' }} In Stock
                        </span>
                    </div>

                    <script>
                        function copySKU() {
                            const skuText = document.getElementById('sku').innerText.replace('SKU: ', '');
                            navigator.clipboard.writeText(skuText).then(() => {});
                        }
                    </script>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center justify-between">
                            <span
                                class="text-2xl font-semibold text-primary mr-4">₹{{ number_format($productdetails->price, 2) }}</span>
                            <span
                                class="text-lg font-medium text-secondary mr-2 line-through">₹{{ number_format($productdetails->original_price,2) }}</span>
                        </div>
                    </div>
                    <div class="flex items-center mb-5">
                        <span class="text-xs text-gray-500 mr-4">(MRP Inclusive of all taxes)</span>
                    </div>

                    <p class="text-gray-600 text-base leading-relaxed mb-6">
                        {!! $productdetails->description !!}
                    </p>

                    <!-- Highlights -->
                    <ul class="space-y-3 mb-8 text-sm my-3">
                        <li class="flex items-center gap-2 text-gray-800">
                            <i class="fa-solid fa-certificate text-primary"></i>
                            Certified Gifts
                        </li>
                        <li class="flex items-center gap-2 text-gray-800">
                            <i class="fa-solid fa-rotate-left text-primary"></i>
                            15-Day Money-Back Guarantee
                        </li>
                        <li class="flex items-center gap-2 text-gray-800">
                            <i class="fa-solid fa-arrows-rotate text-primary"></i>
                            Exchange Available
                        </li>
                        <li class="flex items-center gap-2 text-gray-800">
                            <i class="fa-solid fa-shield-heart text-primary"></i>
                            1-Year Warranty
                        </li>
                        <li class="flex items-center gap-2 text-gray-800">
                            <i class="fa-solid fa-gift text-primary"></i>
                            Comes in a Premium Gift Box
                        </li>
                    </ul>

                    <div class="mb-8">
                        <p class="text-gray-900 text-lg font-medium mb-3">Choose Option</p>
                        <div class="flex flex-wrap gap-3">
                            @if ($productdetails->variants && $productdetails->variants->count())
                                @foreach ($productdetails->variants as $pd)
                                    <button
                                        class="px-4 py-2 border rounded-full text-gray-700 hover:bg-pink-50 hover:border-pink-400">
                                        {{ $pd->size }}
                                    </button>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div x-data="{ quantity: 1 }" class="flex items-center gap-4 mb-8">
                        <span class="text-gray-900 text-lg font-medium">Quantity:</span>
                        <div class="flex items-center border rounded">
                            <button @click="quantity = Math.max(1, quantity - 1)"
                                class="px-3 py-2 text-primary hover:bg-secondary">-</button>
                            <input type="text" x-model="quantity" class="w-12 text-center border-x text-gray-900"
                                readonly />
                            <button @click="quantity++" class="px-3 py-2 text-primary hover:bg-secondary">+</button>
                        </div>
                    </div>

                    <p class="text-sm text-primary mb-6">
                        <i class="fa-solid fa-truck"></i> Estimated delivery:
                        <span class="text-gray-800 font-medium">5-7 business days</span>
                    </p>

                    <div class="flex flex-col sm:flex-row mb-6 gap-4">
                        @if (Auth::check())
                            <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::check() ? Auth::id() : '' }}">
                                <input type="hidden" name="product_id" value="{{ $productdetails->id }}">
                                <input type="hidden" name="quantity" x-bind:value="quantity" value="1">
                                <button type="submit"
                                    class="w-full text-center flex-1 bg-primary text-white py-3 rounded text-lg shadow-md hover:bg-primary/90 transition">
                                    Add to Cart
                                </button>
                            </form>

                            <form action="{{ route('buy.now') }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::check() ? Auth::id() : '' }}">
                                <input type="hidden" name="product_id" value="{{ $productdetails->id }}">
                                <input type="hidden" name="quantity" x-bind:value="quantity">
                                <button type="submit"
                                    class="w-full text-center flex-1 border hover:border-secondary border-primary text-primary py-3 rounded text-lg hover:bg-secondary transition">
                                    Buy Now
                                </button>
                            </form>
                        @else
                            <a href="{{ url('/login') }}"
                                class="w-full text-center flex-1 bg-primary text-white py-3 rounded text-lg shadow-md hover:bg-primary/90 transition">
                                Add to Cart
                            </a>
                            <a href="{{ url('/login') }}"
                                class="w-full text-center flex-1 border hover:border-secondary border-primary text-primary py-3 rounded text-lg hover:bg-secondary transition">
                                Buy Now
                            </a>
                        @endif
                    </div>

                    <!-- ✅ Customization Form kept fully intact -->
                    <div class="border-t border-gray-200 pt-8 mt-10 mb-5">
                        <h3 class="text-2xl font-semibold text-secondary mb-6 flex items-center gap-2">
                            <i class="fa-solid fa-wand-magic-sparkles text-primary"></i>
                            Customize Your Gift
                        </h3>

                        <form class="space-y-6" action="{{ route('product.customize') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $productdetails->id }}">
                            <div>
                                <label for="message" class="block text-gray-700 font-medium mb-2">
                                    Personalized Message
                                </label>
                                <textarea id="message" name="message" rows="3" placeholder="Write your message here (optional)"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary focus:outline-none resize-none text-gray-800"></textarea>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-medium mb-2">
                                    Upload Photos (Max 4)
                                </label>
                                <input type="file" id="images" name="images[]" multiple accept="image/*"
                                    class="block w-full text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary/90" />
                                <p class="text-sm text-gray-500 mt-2">You can upload up to 4 images for customization (e.g., logo, photo, or design).</p>
                            </div>

                            <div>
                                <label for="theme-color" class="block text-gray-700 font-medium mb-2">
                                    Enter Theme or Color Preference
                                </label>
                                <div class="flex items-center gap-3">
                                    <input type="text" id="theme-color" name="theme-color" readonly
                                        placeholder="Select a color from the picker"
                                        class="flex-1 border border-gray-300 rounded-lg px-4 py-3 bg-gray-50 text-gray-800 cursor-not-allowed focus:outline-none" />
                                    <input type="color" id="color-picker" name="color-picker"
                                        class="w-12 h-12 border p-1 border-gray-300 rounded-lg cursor-pointer hover:scale-105 transition-transform" />
                                </div>
                                <p class="text-sm text-gray-500 mt-2">Pick a color and its code will automatically appear above.</p>
                            </div>

                            <script>
                                const colorPicker = document.getElementById('color-picker');
                                const themeColorInput = document.getElementById('theme-color');
                                colorPicker.addEventListener('input', function() {
                                    themeColorInput.value = this.value;
                                });
                            </script>

                            <div>
                                <label for="notes" class="block text-gray-700 font-medium mb-2">
                                    Additional Instructions
                                </label>
                                <textarea id="notes" name="notes" rows="3"
                                    placeholder="Describe any other customization details (e.g., font, pattern, wrapping preference)"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary focus:outline-none resize-none text-gray-800"></textarea>
                            </div>

                            <div class="flex items-center gap-3">
                                <input type="checkbox" id="gift-wrap" name="gift-wrap"
                                    class="h-5 w-5 accent-secondary">
                                <label for="gift-wrap" class="text-gray-700 font-medium">
                                    Add Premium Gift Wrapping (₹199)
                                </label>
                            </div>

                            <div class="pt-4">
                                <button type="submit"
                                    class="w-full bg-secondary text-white py-3 rounded text-lg font-medium shadow-md hover:bg-secondary/90 transition-all duration-300 flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-gift"></i> Send Customization
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="max-w-4xl mx-auto mb-5 flex flex-row items-center justify-evenly">
                        <div class="flex flex-col items-center text-center">
                            <img src="/images/cm-removebg-preview.png" alt="Ramratan Logo" class="h-5 object-contain" />
                            <p class="font-semibold text-gray-700 text-[0.6rem]">Trust of Customers</p>
                            <p class="text-gray-500 text-[0.5rem]">Spirit of Balaji Gift House</p>
                        </div>

                        <div class="flex flex-col items-center text-center">
                            <img src="/images/certified.png" alt="Certified Logo" class="h-5 object-contain" />
                            <p class="font-semibold text-gray-700 text-[0.6rem]">100% Certified</p>
                            <p class="text-gray-500 text-[0.5rem]">by Balaji Gift House</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ✅ Fixed Script -->
<script>
    function asset(path) {
        return "{{ asset('') }}" + path.replace(/^\/+/, '');
    }

    function galleryComponent(images) {
        const mainImage = asset("{{ $productdetails->image }}");
        const galleryImages = Array.isArray(images) && images.length
            ? images.map(img => asset(img))
            : [];
        const allImages = [mainImage, ...galleryImages.filter(img => img !== mainImage)];

        return {
            images: allImages.length ? allImages : [asset('images/no-image.png')],
            currentIndex: 0,
            get currentImage() {
                return this.images[this.currentIndex];
            },
            select(index) {
                this.currentIndex = index;
            },
            next() {
                this.currentIndex = (this.currentIndex + 1) % this.images.length;
            },
            prev() {
                this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
            },
        };
    }
</script>
