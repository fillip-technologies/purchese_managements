<section class="max-w-7xl mx-auto px-4 py-12">
    <div class="flex items-center justify-between mb-10">
        <h2 class="text-2xl font-semibold tracking-wide text-primary flex items-center gap-3">
            <i class="fa-regular fa-heart text-primary"></i> My Wishlist
        </h2>
        <span class="text-gray-500 text-sm">{{ count($wishlists) }} items</span>
    </div>

    @if (session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 text-red-600">{{ session('error') }}</div>
    @endif

    @if ($wishlists->count() > 0)
        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($wishlists as $item)
        
                <div class="group relative">
                    <div class="overflow-hidden rounded relative">
                        <img src="{{ $item->image }}"
                            class="w-full h-72 object-cover group-hover:scale-105 transition duration-500 ease-in-out" />

                        <form action="{{ route('wishlist.remove') }}" method="POST"
                            class="absolute top-4 right-4">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="product_id" value="{{ $item->id }}">
                            <button type="submit"
                                class="bg-white/90 backdrop-blur-md hover:bg-secondary/50 text-primary rounded-full w-10 h-10 flex items-center justify-center shadow">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </form>
                    </div>

                    <div class="mt-4 text-center">
                        <h3 class="text-lg font-medium text-gray-800 transition">{{ $item->name }}</h3>
                        <p class="text-primary font-semibold mt-1">₹{{ $item->price }}</p>

                        <div class="mt-4">
                            @if (Auth::check())
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                    <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit"
                                        class="w-full bg-gradient-to-r from-primary to-primary/80 hover:opacity-90 text-white font-medium py-2.5 rounded shadow-md transition">
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <a href="{{ url('/login') }}"
                                    class="w-full bg-gradient-to-r from-primary to-primary/80 hover:opacity-90 text-white font-medium py-2.5 rounded shadow-md transition">
                                    Add to Cart <i class="fa-solid fa-bag-shopping text-lg ml-2"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-20 text-gray-500">
            <i class="fa-regular fa-heart text-5xl text-primary mb-4"></i>
            <p class="text-xl">Your wishlist is empty</p>
            <p class="text-gray-400 mt-1">
                Start adding your favorite jewelry pieces
                <i class="fa-solid fa-wand-magic-sparkles text-primary"></i>
            </p>
        </div>
    @endif
</section>
