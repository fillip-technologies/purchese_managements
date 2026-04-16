<nav class="mt-6 flex-1 overflow-y-auto bg-white border-r border-gray-100">

    <!-- Heading -->
    <div class="px-5 mb-4">
        <p class="text-[11px] uppercase text-gray-400 font-semibold tracking-widest">Navigation</p>
    </div>

    <!-- Dashboard -->
    <a href="{{ url('/admin/dashboard') }}"
        class="sidebar-link flex items-center mx-3 px-4 py-2.5 text-gray-700 rounded-xl hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 group relative">

        <span class="absolute left-0 top-0 h-full w-1 bg-blue-600 rounded-r opacity-0 group-hover:opacity-100"></span>

        <i class="fas fa-chart-line mr-3 text-gray-400 group-hover:text-blue-600"></i>
        Dashboard
    </a>

    <!-- Users -->
    {{-- <a href="{{ url('/list/users') }}"
        class="sidebar-link flex items-center mx-3 mt-1 px-4 py-2.5 text-gray-700 rounded-xl hover:bg-blue-50 hover:text-blue-700 transition group">

        <i class="fas fa-users mr-3 text-gray-400 group-hover:text-blue-600"></i>
        Users
    </a>

    <!-- Orders -->
    <a href="{{ url('/list/order') }}"
        class="sidebar-link flex items-center mx-3 mt-1 px-4 py-2.5 text-gray-700 rounded-xl hover:bg-blue-50 hover:text-blue-700 transition group">

        <i class="fas fa-box mr-3 text-gray-400 group-hover:text-blue-600"></i>
        Orders
    </a> --}}

    <!-- Section Divider -->
    <div class="mx-4 my-3 border-t border-gray-100"></div>

    <!-- Dropdown -->
    <details class="group mx-3">
        <summary class="flex items-center justify-between cursor-pointer px-4 py-2.5 text-gray-700 rounded-xl hover:bg-blue-50 transition">

            <div class="flex items-center">
                <i class="fas fa-users mr-3 text-gray-400 group-open:text-blue-600"></i>
               Master Setup
            </div>

            <i class="fas fa-chevron-down text-xs text-gray-400 group-open:rotate-180 transition"></i>
        </summary>

        <div class="pl-10 mt-1 flex flex-col space-y-1 text-sm">
            <a href="{{ route('users') }}" class="text-gray-500 hover:text-blue-600 transition">Add Users</a>
             <a href="{{ route('add.vendors') }}" class="text-gray-500 hover:text-blue-600 transition">Add Vendors</a>
              <a href="{{ route('add.clients') }}" class="text-gray-500 hover:text-blue-600 transition">Add Clients</a>
               <a href="{{ route('add.addproduct') }}" class="text-gray-500 hover:text-blue-600 transition">Add Products</a>

        </div>
    </details>

    <!-- Category -->
    <details class="group mx-3 mt-1">
        <summary class="flex items-center justify-between cursor-pointer px-4 py-2.5 text-gray-700 rounded-xl hover:bg-blue-50">

            <div class="flex items-center">
                <i class="fas fa-layer-group mr-3 text-gray-400 group-open:text-blue-600"></i>
                Vendors
            </div>

            <i class="fas fa-chevron-down text-xs text-gray-400 group-open:rotate-180 transition"></i>
        </summary>

        <div class="pl-10 mt-1 flex flex-col space-y-1 text-sm">
            <a href="{{ route('add.vendor.product') }}" class="text-gray-500 hover:text-blue-600 transition">Add Vendors Products</a>

        </div>
    </details>

    {{-- <!-- SubCategory -->
    <details class="group mx-3 mt-1">
        <summary class="flex items-center justify-between cursor-pointer px-4 py-2.5 text-gray-700 rounded-xl hover:bg-blue-50">

            <div class="flex items-center">
                <i class="fas fa-sitemap mr-3 text-gray-400 group-open:text-blue-600"></i>
                SubCategory
            </div>

            <i class="fas fa-chevron-down text-xs text-gray-400 group-open:rotate-180 transition"></i>
        </summary>

        <div class="pl-10 mt-1 flex flex-col space-y-1 text-sm">
            <a href="{{ url('subcat') }}" class="text-gray-500 hover:text-blue-600">Add SubCategory</a>
            <a href="{{ url('list/subcate') }}" class="text-gray-500 hover:text-blue-600">All SubCategory</a>
        </div>
    </details>

    <!-- Products -->
    <details class="group mx-3 mt-1">
        <summary class="flex items-center justify-between cursor-pointer px-4 py-2.5 text-gray-700 rounded-xl hover:bg-blue-50">

            <div class="flex items-center">
                <i class="fas fa-box-open mr-3 text-gray-400 group-open:text-blue-600"></i>
                Products
            </div>

            <i class="fas fa-chevron-down text-xs text-gray-400 group-open:rotate-180 transition"></i>
        </summary>

        <div class="pl-10 mt-1 flex flex-col space-y-1 text-sm">
            <a href="{{ route('admin.venue.add') }}" class="text-gray-500 hover:text-blue-600">Add Products</a>
            <a href="{{ route('poducts.listing') }}" class="text-gray-500 hover:text-blue-600">All Products</a>
        </div>
    </details>

    <!-- Shipping -->
    <details class="group mx-3 mt-1">
        <summary class="flex items-center justify-between cursor-pointer px-4 py-2.5 text-gray-700 rounded-xl hover:bg-blue-50">

            <div class="flex items-center">
                <i class="fas fa-truck mr-3 text-gray-400 group-open:text-blue-600"></i>
                Shipping
            </div>

            <i class="fas fa-chevron-down text-xs text-gray-400 group-open:rotate-180 transition"></i>
        </summary>

        <div class="pl-10 mt-1 flex flex-col space-y-1 text-sm">
            <a href="{{ url('shipping/list') }}" class="text-gray-500 hover:text-blue-600">All Shipping</a>
            <a href="{{ url('shipping') }}" class="text-gray-500 hover:text-blue-600">Add Shipping</a>
        </div>
    </details>

    <!-- Divider -->
    <div class="mx-4 my-3 border-t border-gray-100"></div>

    <!-- Other Links -->
    <a href="{{ route('custom.list') }}"
        class="sidebar-link flex items-center mx-3 px-4 py-2.5 text-gray-700 rounded-xl hover:bg-blue-50 transition group">
        <i class="fas fa-map mr-3 text-gray-400 group-hover:text-blue-600"></i>
        Order Request
    </a>

    <a href="{{ url('admin/productCustomoze') }}"
        class="sidebar-link flex items-center mx-3 mt-1 px-4 py-2.5 text-gray-700 rounded-xl hover:bg-blue-50 transition group">
        <i class="fas fa-sliders-h mr-3 text-gray-400 group-hover:text-blue-600"></i>
        Custom Orders
    </a> --}}

</nav>
