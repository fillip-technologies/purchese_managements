<!-- Featured Products Section -->
<div class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <!-- Section Heading -->
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-semibold text-gray-800">Featured Products</h2>
            <p class="text-gray-500 mt-2 text-sm">Our handpicked selection just for you</p>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

            <!-- Product Card -->
            @foreach ($featureproduct as $feature)
                <a href="{{ route('product-details', $feature->slug) }}"
                    class="bg-white border rounded-lg shadow-sm p-5 hover:shadow-md transition-transform duration-300 hover:-translate-y-1">
                    <div class="w-full flex justify-center">
                        <img src="{{ asset($feature->image) }}" alt="Diamond Ring"
                            class="h-44 object-contain transition-transform duration-300 hover:scale-105" />
                    </div>
                    <div class="mt-4 space-y-2">
                        <h3 class="text-gray-800 font-medium text-base truncate">{{ $feature->name }}</h3>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <span class="text-primary font-bold text-lg">₹{{ $feature->price }}.00</span>
                                <span class="text-secondary line-through text-sm">₹{{ $feature->original_price }}.00</span>
                            </div>
                            <button
                                class="p-2 rounded-full bg-secondary/40 text-primary hover:bg-secondary/30 transition-colors">
                                <i class="fa-solid fa-bag-shopping text-lg"></i>
                            </button>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>


        <div class="mt-12 text-center">
            <a href="{{  route('view-product') }}"
                class="inline-block bg-white text-primary px-6 py-3 shadow hover:bg-primary hover:text-white border border-primary transition">
                View All Products
            </a>
        </div>
    </div>
</div>
