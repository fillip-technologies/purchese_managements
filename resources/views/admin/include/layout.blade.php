<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel')) - Dashboard</title>

    <!-- Tailwind CSS CDN v3 + Font Awesome Icons -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
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
        </aside>
        
        <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 transition-opacity duration-300 lg:hidden opacity-0 pointer-events-none"></div>
        
        <!-- ========== MAIN CONTENT ========== -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <header class="bg-white shadow-sm z-10">
                <div class="px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button id="toggleSidebarBtn" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-lg p-1">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-xl font-semibold text-gray-800">@yield('header', 'Dashboard')</h1>
                    </div>
                    
                    <!-- ========== MULTI-ITEM DROPDOWN ========== -->
                    <div class="relative" x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" 
                                class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-lg px-3 py-2">
                            <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center">
                                <span class="text-indigo-700 font-medium text-sm">JD</span>
                            </div>
                            <span class="hidden sm:inline-block text-sm font-medium">John Doe</span>
                            <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': dropdownOpen }"></i>
                        </button>
                        
                        <!-- Dropdown Menu with Multiple Items -->
                        <div x-show="dropdownOpen" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95 -translate-y-2"
                             x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 transform scale-95 -translate-y-2"
                             class="absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
                             style="display: none;">
                            <div class="py-1" role="menu" aria-orientation="vertical">
                                <!-- Header with user info -->
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-900">John Doe</p>
                                    <p class="text-xs text-gray-500 truncate">john.doe@example.com</p>
                                </div>
                                
                                <!-- Menu Items with Icons -->
                                <a href="" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-150" role="menuitem">
                                    <i class="fas fa-user-circle w-5 h-5 mr-3 text-gray-400"></i>
                                    <span>Your Profile</span>
                                </a>
                                
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-150" role="menuitem">
                                    <i class="fas fa-address-card w-5 h-5 mr-3 text-gray-400"></i>
                                    <span>Account Settings</span>
                                </a>
                                
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-150" role="menuitem">
                                    <i class="fas fa-bell w-5 h-5 mr-3 text-gray-400"></i>
                                    <span>Notifications</span>
                                    <span class="ml-auto inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">3</span>
                                </a>
                                
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-150" role="menuitem">
                                    <i class="fas fa-shield-alt w-5 h-5 mr-3 text-gray-400"></i>
                                    <span>Privacy & Security</span>
                                </a>
                                
                                <div class="border-t border-gray-100 my-1"></div>
                                
                                <!-- Nested Dropdown Example -->
                                <div class="relative" x-data="{ submenuOpen: false }">
                                    <button @click="submenuOpen = !submenuOpen" 
                                            class="w-full flex items-center justify-between px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors duration-150"
                                            role="menuitem">
                                        <div class="flex items-center">
                                            <i class="fas fa-globe w-5 h-5 mr-3 text-gray-400"></i>
                                            <span>Language</span>
                                        </div>
                                        <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                                    </button>
                                    
                                    <!-- Submenu -->
                                    <div x-show="submenuOpen" 
                                         x-transition:enter="transition ease-out duration-150"
                                         x-transition:enter-start="opacity-0 transform -translate-x-2"
                                         x-transition:enter-end="opacity-100 transform translate-x-0"
                                         x-transition:leave="transition ease-in duration-100"
                                         x-transition:leave-start="opacity-100 transform translate-x-0"
                                         x-transition:leave-end="opacity-0 transform -translate-x-2"
                                         class="absolute left-full top-0 mt-0 ml-1 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
                                         style="display: none;">
                                        <div class="py-1">
                                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="fas fa-flag-usa w-4 h-4 mr-3 text-gray-400"></i>
                                                <span>English</span>
                                                <i class="fas fa-check ml-auto text-green-500 text-xs"></i>
                                            </a>
                                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="fas fa-flag w-4 h-4 mr-3 text-gray-400"></i>
                                                <span>Spanish</span>
                                            </a>
                                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="fas fa-flag w-4 h-4 mr-3 text-gray-400"></i>
                                                <span>French</span>
                                            </a>
                                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="fas fa-flag w-4 h-4 mr-3 text-gray-400"></i>
                                                <span>German</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="border-t border-gray-100 my-1"></div>
                                
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-150" role="menuitem">
                                    <i class="fas fa-sign-out-alt w-5 h-5 mr-3 text-red-400"></i>
                                    <span>Sign Out</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 bg-gray-50">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
            
            <footer class="bg-white border-t py-3 px-4 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </footer>
        </div>
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