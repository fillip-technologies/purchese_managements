<section x-data="categoriesSection()" class="py-16 bg-primary md:hidden">
    <div class="max-w-7xl mx-auto px-5 text-center">
        <h2 class="text-3xl font-serif font-semibold text-secondary tracking-wide">
            Shop by Categories
        </h2>
        <p class="text-gray-300 text-sm mt-2 mb-10">
            Explore what you love — click to browse each category
        </p>
        @php
            $images = [
                asset('images/categories/1.webp'),
                asset('images/categories/2.webp'),
                asset('images/categories/3.webp'),
                asset('images/categories/4.webp'),
                asset('images/categories/5.webp'),
            ];

            $categories = App\Models\Category::all();
        @endphp

        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-7 gap-4 sm:gap-6">
            @foreach ($categories as $index => $cat)
                <div
                    class="group flex flex-col items-center text-center cursor-pointer transition-transform hover:-translate-y-1">

                    <a href="{{ route('subcategory.show', [$cat->id, Str::slug($cat->name)]) }}">
                        <img src="{{ $images[$index] }}" alt="{{ $cat['name'] }}"
                            class="w-16 h-16 sm:w-20 sm:h-20 rounded-full object-cover border-2 border-secondary shadow-md group-hover:scale-105 transition" />
                    </a>
                    <h3
                        class="mt-2 sm:mt-3 text-[0.75rem] sm:text-sm md:text-base font-semibold text-white group-hover:text-white transition">
                        {{ $cat['name'] }}
                    </h3>
                </div>
            @endforeach
        </div>
    </div>

</section>
