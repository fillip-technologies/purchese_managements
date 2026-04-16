<div id="productContainer">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($products as $viewproduct)
            <div class="bg-white border rounded-lg shadow-sm p-5 hover:shadow-md transition-transform duration-300 hover:-translate-y-1">
                <a href="{{ route('product-details', $viewproduct->slug) }}" class="w-full flex justify-center">
                    <img src="{{ asset($viewproduct->image) }}" alt="{{ $viewproduct->name }}" class="h-44 object-contain transition-transform duration-300 hover:scale-105" />
                </a>

                <div class="mt-4 space-y-2">
                    <h3 class="text-gray-800 font-medium text-base truncate">{{ $viewproduct->name }}</h3>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-2">
                            <span class="text-primary font-bold text-lg">
                                ₹{{ number_format($viewproduct->price, 2) }}
                            </span>
                            <span class="text-secondary line-through text-sm">
                                ₹{{ number_format($viewproduct->original_price, 2) }}
                            </span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center min-h-[1.5rem]">
                        <span class="text-primary/80 text-sm">{{ $viewproduct->discount }}% discount for today</span>
                    </div>
                </div>

                <div class="mt-4">
                    @auth
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <input type="hidden" name="product_id" value="{{ $viewproduct->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit"
                                class="block text-center w-full bg-gradient-to-r from-primary to-primary/90 hover:opacity-90 text-white font-medium py-2.5 rounded shadow-md transition">
                                Add to Cart
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="block text-center w-full bg-gradient-to-r from-primary to-primary/90 hover:opacity-90 text-white font-medium py-2.5 rounded shadow-md transition">
                            Add to Cart <i class="fa-solid fa-bag-shopping text-lg ml-2"></i>
                        </a>
                    @endauth
                </div>
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-500 py-8">No products found.</p>
        @endforelse
    </div>

    <div class="flex justify-center mt-12 pagination">
        {{ $products->links('pagination::tailwind') }}
    </div>
</div>
