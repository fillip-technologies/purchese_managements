<div class="flex flex-col items-center py-16 bg-white relative overflow-hidden">
    <div class="mb-10 text-center">
        <h2 class="text-3xl font-serif font-semibold text-gray-800 tracking-wide">
            New Arrival
        </h2>
        <p class="text-gray-500 text-sm mt-2">
            Discover our latest collections
        </p>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Card 1 -->
        @foreach ($newsection as $new_Arrival)
            <a href="{{ route('product-details' , $new_Arrival->slug) }}"
                class="relative max-w-xs bg-white border rounded-xl shadow-sm p-5 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">

                <span
                    class="absolute top-3 left-3 bg-primary text-white text-xs px-3 py-1 rounded-full shadow z-10">Sale</span>


                <div class="w-full flex justify-center">
                    <img src="{{ asset($new_Arrival->image) }}" alt="Sterling Silver Band Ring"
                        class="h-44 object-contain transition-transform duration-300 hover:scale-105" />
                </div>


                <div class="mt-5 space-y-3">

                    <h3 class="text-gray-800 font-semibold text-base">
                        {{ $new_Arrival->name }}
                    </h3>


                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-2">
                            <span class="text-primary font-bold text-lg">₹{{ $new_Arrival->price }}.00</span>
                            <span class="text-secondary line-through text-sm">₹{{ $new_Arrival->original_price }}.00</span>
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


    <div class="mt-12">
        <a href="{{ route('view-product') }}"
            class="px-6 py-3 bg-white text-primary hover:bg-primary hover:text-white transition border border-primary">
            View All
        </a>
    </div>
</div>
