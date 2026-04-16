<div class="hidden md:flex justify-center bg-white shadow-sm py-3 space-x-8 text-gray-700 text-lg font-light">

    <!-- Birthday Gifts -->

    @php
        
        $categories = App\Models\Category::all();
        $subcategories = App\Models\Subcategory::all();
    @endphp

    @foreach ($categories as $category)
        <div x-data="{ open: false }" class="relative">
            <a href="#" @click.prevent="open = !open"
                class="flex items-center space-x-1 hover:text-primary cursor-pointer">
                <span>{{ $category->name }}</span>
                <i class="fas fa-chevron-down text-sm transition-transform" :class="open ? 'rotate-180' : ''"></i>
            </a>

            <div x-show="open" @click.away="open = false" x-transition x-cloak
                class="absolute top-full left-0 mt-2 w-56 bg-white shadow-lg border rounded z-20">

                @php
                    $filteredSubcategories = $subcategories->where('category_id', $category->id);
                @endphp

                @forelse ($filteredSubcategories as $sub)

                    <a href="{{ route('subcategory.show', [$sub->category_id, Str::slug($sub->name)]) }}"
                        class="block px-4 py-2 hover:bg-secondary text-primary">
                        {{ $sub->name }}
                    </a>


                @empty
                    <span class="block px-4 py-2 text-gray-500 text-sm">No subcategories</span>
                @endforelse
            </div>
        </div>
    @endforeach



    <!-- Anniversary Gifts -->
    {{-- <div x-data="{ open: false }" class="relative">
        <a href="#" @click.prevent="open = !open"
            class="flex items-center space-x-1 hover:text-primary cursor-pointer">
            <span>Anniversary Gifts</span>
            <i class="fas fa-chevron-down text-sm transition-transform" :class="open ? 'rotate-180' : ''"></i>
        </a>

        <div x-show="open" @click.away="open = false" x-transition x-cloak
            class="absolute top-full left-0 mt-2 w-56 bg-white shadow-lg border rounded z-20">
            <a href="#" class="block px-4 py-2 hover:bg-secondary text-primary">Couple Name Frames</a>
            <a href="#" class="block px-4 py-2 hover:bg-secondary text-primary">Customized Lamps</a>
            <a href="#" class="block px-4 py-2 hover:bg-secondary text-primary">Engraved Wooden Plaques</a>
            <a href="#" class="block px-4 py-2 hover:bg-secondary text-primary">Photo Collage Gifts</a>
        </div>
    </div>

    <!-- Office Decor -->
    <div x-data="{ open: false }" class="relative">
        <a href="#" @click.prevent="open = !open" class="flex items-center space-x-1 hover:text-primary">
            <span>Office Decor</span>
            <i class="fas fa-chevron-down text-sm transition-transform" :class="open ? 'rotate-180' : ''"></i>
        </a>

        <div x-show="open" @click.away="open = false" x-transition x-cloak
            class="absolute top-full left-0 mt-2 w-56 bg-white shadow-lg border rounded z-20">
            <a href="#" class="block px-4 py-2 hover:bg-secondary text-primary">Customized Desk Nameplates</a>
            <a href="#" class="block px-4 py-2 hover:bg-secondary text-primary">Photo Calendars</a>
            <a href="#" class="block px-4 py-2 hover:bg-secondary text-primary">Motivational Frames</a>
            <a href="#" class="block px-4 py-2 hover:bg-secondary text-primary">Personalized Desk Organizers</a>
        </div>
    </div>

    <!-- Premium Gifts -->
    <div x-data="{ open: false }" class="relative">
        <a href="#" @click.prevent="open = !open" class="flex items-center space-x-1 hover:text-primary">
            <span>Premium Gifts</span>
            <i class="fas fa-chevron-down text-sm transition-transform" :class="open ? 'rotate-180' : ''"></i>
        </a>

        <div x-show="open" @click.away="open = false" x-transition x-cloak
            class="absolute top-full left-0 mt-2 w-56 bg-white shadow-lg border rounded z-20">
            <a href="#" class="block px-4 py-2 hover:bg-secondary text-primary">Luxury Gift Hampers</a>
            <a href="#" class="block px-4 py-2 hover:bg-secondary text-primary">Personalized LED Frames</a>
            <a href="#" class="block px-4 py-2 hover:bg-secondary text-primary">Engraved Metal Pens</a>
            <a href="#" class="block px-4 py-2 hover:bg-secondary text-primary">Premium Wooden Boxes</a>
        </div>
    </div>

    <!-- Personalized Frame -->
    <div x-data="{ open: false }" class="relative">
        <a href="#" @click.prevent="open = !open" class="flex items-center space-x-1 hover:text-primary">
            <span>Personalized Frame</span>
            <i class="fas fa-chevron-down text-sm transition-transform" :class="open ? 'rotate-180' : ''"></i>
        </a>

        <div x-show="open" @click.away="open = false" x-transition x-cloak
            class="absolute top-full left-0 mt-2 w-56 bg-white shadow-lg border rounded z-20">
            <a href="#" class="block px-4 py-2 hover:bg-secondary text-primary">Name & Quote Frames</a>
            <a href="#" class="block px-4 py-2 hover:bg-secondary text-primary">Love Story Frames</a>
            <a href="#" class="block px-4 py-2 hover:bg-secondary text-primary">Photo Collage Frames</a>
            <a href="#" class="block px-4 py-2 hover:bg-secondary text-primary">3D Acrylic Frames</a>
        </div>
    </div> --}}

</div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
