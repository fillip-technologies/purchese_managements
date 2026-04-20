<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel')) - Dashboard</title>

    <!-- Tailwind CSS CDN v3 + Font Awesome Icons -->
    <script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    transitionProperty: {
                        'width': 'width',
                        'spacing': 'margin, padding',
                    },
                    width: {
                        '72': '18rem',
                        '80': '20rem',
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        body.no-scroll {
            overflow: hidden;
        }
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-scroll::-webkit-scrollbar-track {
            background: #2d3748;
        }
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #4a5568;
            border-radius: 4px;
        }
        /* Dropdown animations */
        .dropdown-enter {
            opacity: 0;
            transform: scale(0.95) translateY(-10px);
        }
        .dropdown-enter-active {
            opacity: 1;
            transform: scale(1) translateY(0);
            transition: all 0.2s ease-out;
        }
        .dropdown-exit {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
        .dropdown-exit-active {
            opacity: 0;
            transform: scale(0.95) translateY(-10px);
            transition: all 0.15s ease-in;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">

        <!-- ========== SIDEBAR ========== -->
        <aside id="sidebar"
               class="sidebar-transition fixed inset-y-0 left-0 z-30 w-64 bg-gradient-to-b from-gray-800 to-gray-900 text-white shadow-xl lg:relative lg:translate-x-0
                      -translate-x-full">

            <div class="flex items-center justify-between px-4 py-5 border-b border-gray-700">
                <div class="flex items-center space-x-3">
                    <div class="h-8 w-8 rounded-full bg-indigo-500 flex items-center justify-center">
                        <span class="text-white font-bold text-sm">L</span>
                    </div>
                    <span class="text-xl font-semibold tracking-wide">{{ config('app.name', 'Laravel') }}</span>
                </div>
                <button id="closeSidebarBtn" class="lg:hidden text-gray-400 hover:text-white focus:outline-none">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <nav class="flex-1 px-2 py-6 space-y-1 overflow-y-auto sidebar-scroll">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2.5 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition duration-200 group">
                    <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                    <span>Dashboard</span>
                </a>

                <!-- Dropdown Example in Sidebar (Nested) -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-2.5 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition duration-200 group">
                        <div class="flex items-center">
                            <i class="fas fa-folder w-5 h-5 mr-3"></i>
                            <span>Products</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': open }"></i>
                    </button>
                    <div x-show="open" x-transition.duration.200ms class="ml-6 mt-1 space-y-1">
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-list w-4 h-4 mr-3"></i>
                            <span>All Products</span>
                        </a>
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-plus w-4 h-4 mr-3"></i>
                            <span>Add New</span>
                        </a>
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-tag w-4 h-4 mr-3"></i>
                            <span>Categories</span>
                        </a>
                    </div>
                </div>

                <a href="#" class="flex items-center px-4 py-2.5 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition duration-200 group">
                    <i class="fas fa-users w-5 h-5 mr-3"></i>
                    <span>Users</span>
                </a>
                <a href="#" class="flex items-center px-4 py-2.5 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition duration-200 group">
                    <i class="fas fa-cog w-5 h-5 mr-3"></i>
                    <span>Settings</span>
                </a>
                <div class="pt-4 mt-4 border-t border-gray-700">
                    <a href="#" class="flex items-center px-4 py-2.5 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition duration-200 group">
                        <i class="fas fa-question-circle w-5 h-5 mr-3"></i>
                        <span>Help & Support</span>
                    </a>
                </div>
            </nav>

            <div class="p-4 border-t border-gray-700">
                <div class="flex items-center space-x-3">
                    <div class="h-8 w-8 rounded-full bg-gray-600 flex items-center justify-center">
                        <i class="fas fa-user text-gray-300 text-sm"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-200 truncate">John Doe</p>
                        <p class="text-xs text-gray-400 truncate">admin@example.com</p>
                    </div>
                </div>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium text-gray-700">{{ Auth::guard('admin')->user() ? "Admin" : Auth::guard('user')->user()->full_name }}</p>
                <p class="text-xs text-gray-400 truncate">
                    {{ Auth::guard('admin')->user()->email ?? Auth::guard('user')->user()->email }}
                </p>
            </div>

            <a href="{{ Auth::guard('admin')->user() ?  route('admin.logout') : route('user.logout') }}" class="text-gray-400 hover:text-red-500">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>

    </aside>

    <!-- Main -->
    <div class="flex-1 ml-64 flex flex-col">

        <!-- Topbar -->
        <header class="bg-white border-b px-6 py-4 flex justify-between items-center">
            <h1 class="text-lg font-semibold text-gray-700">@yield('title')</h1>

            <div class="flex items-center gap-4">
                <button class="relative text-gray-500 hover:text-primary">
                    <i class="fas fa-bell"></i>
                    <span class="absolute -top-1 -right-2 bg-red-500 text-white text-[10px] px-1 rounded-full">2</span>
                </button>

                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-gray-200 rounded-full"></div>
                    <span class="text-sm text-gray-600">Admin</span>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="p-6">
            @yield('content')
        </main>

    </div>

    <!-- Alpine.js for dropdown handling (lightweight) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        (function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const toggleBtn = document.getElementById('toggleSidebarBtn');
            const closeBtn = document.getElementById('closeSidebarBtn');

            function isMobile() {
                return window.innerWidth < 1024;
            }

            function openSidebar() {
                if (isMobile()) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('translate-x-0');
                    overlay.classList.remove('opacity-0', 'pointer-events-none');
                    overlay.classList.add('opacity-100', 'pointer-events-auto');
                    document.body.classList.add('no-scroll');
                } else {
                    if (sidebar.classList.contains('w-64')) {
                        sidebar.classList.remove('w-64');
                        sidebar.classList.add('w-20');
                        document.querySelectorAll('#sidebar nav span:not(.w-5)').forEach(span => {
                            span.classList.add('hidden');
                        });
                        document.querySelectorAll('#sidebar nav .flex.items-center').forEach(item => {
                            item.classList.add('justify-center');
                        });
                        const footerDiv = document.querySelector('#sidebar .border-t .flex-1');
                        if (footerDiv) footerDiv.classList.add('hidden');
                        const brandSpan = document.querySelector('#sidebar .flex.items-center span.text-xl');
                        if (brandSpan) brandSpan.classList.add('hidden');
                    } else {
                        sidebar.classList.remove('w-20');
                        sidebar.classList.add('w-64');
                        document.querySelectorAll('#sidebar nav span:not(.w-5)').forEach(span => {
                            span.classList.remove('hidden');
                        });
                        document.querySelectorAll('#sidebar nav .flex.items-center').forEach(item => {
                            item.classList.remove('justify-center');
                        });
                        const footerDiv = document.querySelector('#sidebar .border-t .flex-1');
                        if (footerDiv) footerDiv.classList.remove('hidden');
                        const brandSpan = document.querySelector('#sidebar .flex.items-center span.text-xl');
                        if (brandSpan) brandSpan.classList.remove('hidden');
                    }
                }
            }

            function closeSidebar() {
                if (isMobile()) {
                    sidebar.classList.add('-translate-x-full');
                    sidebar.classList.remove('translate-x-0');
                    overlay.classList.add('opacity-0', 'pointer-events-none');
                    overlay.classList.remove('opacity-100', 'pointer-events-auto');
                    document.body.classList.remove('no-scroll');
                }
            }

            function toggleSidebar() {
                if (isMobile()) {
                    if (sidebar.classList.contains('-translate-x-full')) {
                        openSidebar();
                    } else {
                        closeSidebar();
                    }
                } else {
                    if (sidebar.classList.contains('w-64')) {
                        sidebar.classList.remove('w-64');
                        sidebar.classList.add('w-20');
                        document.querySelectorAll('#sidebar nav span:not(.w-5)').forEach(span => {
                            span.classList.add('hidden');
                        });
                        document.querySelectorAll('#sidebar nav .flex.items-center').forEach(item => {
                            item.classList.add('justify-center');
                            item.classList.remove('justify-start');
                        });
                        const userTextDiv = document.querySelector('#sidebar .border-t .flex-1');
                        if (userTextDiv) userTextDiv.classList.add('hidden');
                        const brandSpan = document.querySelector('#sidebar .flex.items-center span.text-xl');
                        if (brandSpan) brandSpan.classList.add('hidden');
                    } else {
                        sidebar.classList.remove('w-20');
                        sidebar.classList.add('w-64');
                        document.querySelectorAll('#sidebar nav span:not(.w-5)').forEach(span => {
                            span.classList.remove('hidden');
                        });
                        document.querySelectorAll('#sidebar nav .flex.items-center').forEach(item => {
                            item.classList.remove('justify-center');
                            item.classList.add('justify-start');
                        });
                        const userTextDiv = document.querySelector('#sidebar .border-t .flex-1');
                        if (userTextDiv) userTextDiv.classList.remove('hidden');
                        const brandSpan = document.querySelector('#sidebar .flex.items-center span.text-xl');
                        if (brandSpan) brandSpan.classList.remove('hidden');
                    }
                }
            }

            if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
            if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
            if (overlay) overlay.addEventListener('click', closeSidebar);

            let resizeTimer;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    if (!isMobile()) {
                        overlay.classList.add('opacity-0', 'pointer-events-none');
                        document.body.classList.remove('no-scroll');
                        if (sidebar.classList.contains('-translate-x-full')) {
                            sidebar.classList.remove('-translate-x-full');
                            sidebar.classList.add('w-64');
                            sidebar.classList.remove('w-20');
                            document.querySelectorAll('#sidebar nav span:not(.w-5)').forEach(span => {
                                span.classList.remove('hidden');
                            });
                            document.querySelectorAll('#sidebar nav .flex.items-center').forEach(item => {
                                item.classList.remove('justify-center');
                                item.classList.add('justify-start');
                            });
                            const userTextDiv = document.querySelector('#sidebar .border-t .flex-1');
                            if (userTextDiv) userTextDiv.classList.remove('hidden');
                            const brandSpan = document.querySelector('#sidebar .flex.items-center span.text-xl');
                            if (brandSpan) brandSpan.classList.remove('hidden');
                        }
                    } else {
                        if (!sidebar.classList.contains('-translate-x-full')) {
                            sidebar.classList.add('-translate-x-full');
                            sidebar.classList.remove('translate-x-0');
                        }
                        overlay.classList.add('opacity-0', 'pointer-events-none');
                        document.body.classList.remove('no-scroll');
                    }
                }, 150);
            });
        })();
    </script>

    @stack('scripts')
</body>
</html>
