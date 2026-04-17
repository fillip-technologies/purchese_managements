<nav class="mt-6 flex-1 overflow-y-auto bg-white border-r border-gray-100">

    <!-- Heading -->
    <div class="px-5 mb-4">
        <p class="text-[11px] uppercase text-gray-400 font-semibold tracking-widest">Navigation</p>
    </div>

    <a href="{{ Auth::guard('admin')->user() ? url('/admin/dashboard') : route('user.dashboard') }}"
        class="sidebar-link flex items-center mx-3 px-4 py-2.5 text-gray-700 rounded-xl hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 group relative">

        <span class="absolute left-0 top-0 h-full w-1 bg-blue-600 rounded-r opacity-0 group-hover:opacity-100"></span>

        <i class="fas fa-chart-line mr-3 text-gray-400 group-hover:text-blue-600"></i>
        Dashboard
    </a>

    @if (Auth::guard('admin')->user())
        <div class="mx-4 my-3 border-t border-gray-100"></div>

        <details class="group mx-3">
            <summary
                class="flex items-center justify-between cursor-pointer px-4 py-2.5 text-gray-700 rounded-xl hover:bg-blue-50 transition">

                <div class="flex items-center">
                    <i class="fas fa-users mr-3 text-gray-400 group-open:text-blue-600"></i>
                    Master Setup
                </div>

                <i class="fas fa-chevron-down text-xs text-gray-400 group-open:rotate-180 transition"></i>
            </summary>

            <div class="pl-10 mt-1 flex flex-col space-y-1 text-sm">
                <a href="{{ route('users') }}" class="text-gray-500 hover:text-blue-600 transition">Add Users</a>
                <a href="{{ route('add.vendors') }}" class="text-gray-500 hover:text-blue-600 transition">Add
                    Vendors</a>
                <a href="{{ route('add.clients') }}" class="text-gray-500 hover:text-blue-600 transition">Add
                    Clients</a>
                <a href="{{ route('add.addproduct') }}" class="text-gray-500 hover:text-blue-600 transition">Add
                    Products</a>

            </div>
        </details>


        <details class="group mx-3 mt-1">
            <summary
                class="flex items-center justify-between cursor-pointer px-4 py-2.5 text-gray-700 rounded-xl hover:bg-blue-50">

                <div class="flex items-center">
                    <i class="fas fa-layer-group mr-3 text-gray-400 group-open:text-blue-600"></i>
                    Vendors
                </div>

                <i class="fas fa-chevron-down text-xs text-gray-400 group-open:rotate-180 transition"></i>
            </summary>

            <div class="pl-10 mt-1 flex flex-col space-y-1 text-sm">
                <a href="{{ route('add.vendor.product') }}" class="text-gray-500 hover:text-blue-600 transition">Add
                    Vendors Products</a>

            </div>
        </details>
    @else



    <details class="group mx-3 mt-4 mt-1">
            <summary
                class="flex items-center justify-between cursor-pointer px-4 py-2.5 text-gray-700 rounded-xl hover:bg-blue-50">

                <div class="flex items-center">
                    <i class="fas fa-layer-group mr-3 text-gray-400 group-open:text-blue-600"></i>
                    Purchase Requisition
                </div>

                <i class="fas fa-chevron-down text-xs text-gray-400 group-open:rotate-180 transition"></i>
            </summary>

            <div class="pl-10 mt-1 flex flex-col space-y-1 text-sm">
                <a href="{{ route('index.purches') }}" class="text-gray-500 hover:text-blue-600 transition">Add Purchase</a>
            </div>
        </details>
    @endif
</nav>
