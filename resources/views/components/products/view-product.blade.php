@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-16" id="shop">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6 lg:hidden">
            <p class="text-sm text-gray-600">
                Showing {{ $allproduct->firstItem() ?? 0 }}–{{ $allproduct->lastItem() ?? 0 }}
                of {{ $allproduct->total() }} products
            </p>
            <button id="openFilters" class="px-4 py-2 border rounded text-sm text-primary">
                <i class="fa-solid fa-sliders"></i> Filters
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
            <!-- 🟣 Sidebar Filters -->
            <aside id="sidebarFilters"
                class="z-50 hidden lg:block lg:col-span-1 bg-primary rounded shadow p-6 space-y-6 border-2 border-secondary self-start fixed lg:static top-0 left-0 h-full w-80 overflow-y-auto lg:w-auto lg:h-auto">
                <div class="flex items-center justify-end lg:hidden mb-4">
                    <button id="closeFilters" class="text-secondary hover:text-secondary/90">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>

                <h3 class="text-lg text-secondary font-semibold">Filter Products</h3>

                <!-- Category Filter (static for now) -->
                <div>
                    <h4 class="text-sm font-medium text-secondary mb-2">Categories</h4>
                    <ul class="space-y-2 text-sm text-white">
                        <li><label class="flex items-center gap-2"><input type="checkbox" class="accent-secondary" /> Personalized Gifting</label></li>
                        <li><label class="flex items-center gap-2"><input type="checkbox" class="accent-secondary" /> Birthday Gift</label></li>
                        <li><label class="flex items-center gap-2"><input type="checkbox" class="accent-secondary" /> Printing & Branding</label></li>
                        <li><label class="flex items-center gap-2"><input type="checkbox" class="accent-secondary" /> Wall Decor</label></li>
                        <li><label class="flex items-center gap-2"><input type="checkbox" class="accent-secondary" /> Corporate Branding</label></li>
                        <li><label class="flex items-center gap-2"><input type="checkbox" class="accent-secondary" /> Premium Gift</label></li>
                    </ul>
                </div>

                <!-- Price Range -->
                <div>
                    <h4 class="text-sm font-medium text-secondary mb-2">Price</h4>
                    <input type="range" min="5000" max="200000" step="5000" class="w-full accent-secondary" />
                    <div class="flex justify-between text-xs text-white mt-1">
                        <span>₹5,000</span>
                        <span>₹2,00,000</span>
                    </div>
                </div>

                <!-- Stock -->
                <div>
                    <h4 class="text-sm font-medium text-secondary mb-2">Stock Status</h4>
                    <ul class="space-y-2 text-sm text-white">
                        <li><label class="flex items-center gap-2"><input type="checkbox" class="accent-secondary" /> In Stock</label></li>
                    </ul>
                </div>
            </aside>

            <!-- 🟢 Product Grid -->
            <div class="lg:col-span-3">
                <div class="hidden lg:flex items-center justify-between mb-8">
                    <p class="text-sm text-gray-600">
                        Showing {{ $allproduct->firstItem() ?? 0 }}–{{ $allproduct->lastItem() ?? 0 }}
                        of {{ $allproduct->total() }} products
                    </p>
                    <select
                        class="border rounded px-3 py-2 text-sm text-primary focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none">
                        <option>Sort by: Newest</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                    </select>
                </div>

                <!-- 🟣 Product Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($allproduct as $viewproduct)
                        <div class="bg-white border rounded-lg shadow-sm p-5 hover:shadow-md transition-transform duration-300 hover:-translate-y-1">
                            <a href="{{ route('product-details', $viewproduct->slug) }}" class="w-full flex justify-center">
                                <img src="{{ asset($viewproduct->image) }}" alt="{{ $viewproduct->name }}"
                                    class="h-44 object-contain transition-transform duration-300 hover:scale-105" />
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

                <!-- 🟢 Pagination -->
                <div class="flex justify-center mt-12">
                    {{ $allproduct->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 🟠 Sidebar Toggle Script -->
<script>
    const openBtn = document.getElementById("openFilters");
    const closeBtn = document.getElementById("closeFilters");
    const sidebar = document.getElementById("sidebarFilters");

    openBtn?.addEventListener("click", () => sidebar.classList.remove("hidden"));
    closeBtn?.addEventListener("click", () => sidebar.classList.add("hidden"));
</script>
@endsection
