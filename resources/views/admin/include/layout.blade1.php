<!DOCTYPE html>
<html lang="en" id="htmlRoot">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1',
                        secondary: '#10b981',
                        dark: '#111827',
                        accent: '#8b5cf6',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        /* Sidebar Collapsed Styles */
        .sidebar.collapsed {
            width: 80px !important;
        }
        
        .sidebar.collapsed .sidebar-text,
        .sidebar.collapsed .logo-text,
        .sidebar.collapsed .user-info {
            display: none !important;
        }
        
        .sidebar.collapsed .sidebar-link {
            justify-content: center !important;
            padding: 0.625rem !important;
        }
        
        .sidebar.collapsed .sidebar-link i {
            margin-right: 0 !important;
            font-size: 1.25rem !important;
        }
        
        .sidebar.collapsed .logo-container {
            justify-content: center !important;
        }
        
        .sidebar.collapsed .dropdown-btn {
            justify-content: center !important;
            padding: 0.625rem !important;
        }
        
        .sidebar.collapsed .dropdown-btn .flex.items-center {
            justify-content: center;
        }
        
        .sidebar.collapsed .dropdown-btn .flex.items-center i {
            margin-right: 0 !important;
        }
        
        .sidebar.collapsed .dropdown-menu {
            position: fixed;
            left: 80px;
            background: white;
            min-width: 200px;
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            padding: 0.5rem;
            z-index: 100;
        }
        
        .dark .sidebar.collapsed .dropdown-menu {
            background: #1f2937;
            border: 1px solid #374151;
        }
        
        .sidebar.collapsed .dropdown-menu a {
            padding: 0.5rem 1rem;
        }
        
        .main-content.expanded {
            margin-left: 80px !important;
        }
        
        /* Sidebar base styles */
        .sidebar {
            width: 260px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .main-content {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .sidebar-link {
            @apply flex items-center gap-3 px-4 py-2.5 mx-2 rounded-xl text-gray-600 dark:text-gray-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-200;
        }
        
        .sidebar-link.active {
            @apply bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 font-semibold;
        }
        
        .dropdown-btn {
            @apply flex items-center justify-between w-full px-4 py-2.5 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-900/30 transition-all duration-200;
        }
        
        .dropdown-menu {
            transition: all 0.2s ease;
        }
        
        .dropdown-menu.hidden {
            display: none;
        }
        
        /* Dark mode styles */
        .dark {
            color-scheme: dark;
        }
        
        .scrollbar-thin::-webkit-scrollbar {
            width: 5px;
        }
        
        .scrollbar-thin::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        .dark .scrollbar-thin::-webkit-scrollbar-track {
            background: #1f2937;
        }
        
        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        
        .dark .scrollbar-thin::-webkit-scrollbar-thumb {
            background: #4b5563;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }
    </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900 font-sans antialiased">

<div class="flex min-h-screen relative">

    <!-- Sidebar Overlay (Mobile) -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-20 hidden transition-all duration-300 md:hidden"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col fixed h-full z-30 shadow-xl">
        
        <!-- Logo Section -->
        <div class="p-5 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3 logo-container">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-indigo-700 text-white rounded-xl flex items-center justify-center font-bold shadow-lg flex-shrink-0">
                        <i class="fas fa-boxes text-lg"></i>
                    </div>
                    <div class="logo-text transition-opacity duration-300">
                        <h2 class="font-bold text-gray-800 dark:text-white text-lg">PurchasePro</h2>
                        <p class="text-xs text-gray-400 dark:text-gray-500">Management System</p>
                    </div>
                </div>
                <button id="toggleSidebar" class="hidden md:flex w-7 h-7 bg-gray-100 dark:bg-gray-700 hover:bg-indigo-100 dark:hover:bg-indigo-900 rounded-lg items-center justify-center text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all flex-shrink-0">
                    <i id="toggleIcon" class="fas fa-chevron-left text-xs"></i>
                </button>
            </div>
        </div>

        <!-- Sidebar Navigation -->
        <div class="flex-1 overflow-y-auto py-6 scrollbar-thin" id="sidebarNav">
            @include('admin.include.sidebar')
        </div>

        <!-- User Section -->
        <div class="p-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
            <div class="flex items-center gap-3 user-container">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-100 to-indigo-200 dark:from-indigo-900/50 dark:to-indigo-800/50 flex items-center justify-center shadow-inner flex-shrink-0">
                    <i class="fas fa-user-circle text-indigo-600 dark:text-indigo-400 text-xl"></i>
                </div>
                <div class="flex-1 user-info transition-opacity duration-300">
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                        {{ Auth::guard('admin')->user() ? "Administrator" : (Auth::guard('user')->user()->full_name ?? 'User') }}
                    </p>
                    <p class="text-xs text-gray-400 dark:text-gray-500 truncate">
                        {{ Auth::guard('admin')->user()->email ?? (Auth::guard('user')->user()->email ?? 'user@example.com') }}
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <button id="themeToggle" class="w-8 h-8 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-indigo-100 dark:hover:bg-indigo-900 transition-all flex-shrink-0">
                        <i id="themeIcon" class="fas fa-moon"></i>
                    </button>
                    <a href="{{ Auth::guard('admin')->user() ? route('admin.logout') : route('user.logout') }}" 
                       class="text-gray-400 hover:text-red-500 transition-all hover:scale-110 flex-shrink-0" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
                <form id="logout-form" action="{{ Auth::guard('admin')->user() ? route('admin.logout') : route('user.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div id="mainContent" class="main-content flex-1 ml-[260px] transition-all duration-300 flex flex-col min-h-screen">
        
        <!-- Topbar -->
        <header class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-700 sticky top-0 z-20">
            <div class="px-6 py-4 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <button id="mobileMenuBtn" class="md:hidden w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-indigo-100 dark:hover:bg-indigo-900 transition-all">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                    <div class="hidden md:block">
                        <h1 class="text-xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 dark:from-gray-200 dark:to-gray-400 bg-clip-text text-transparent">@yield('title')</h1>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Dashboard overview</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Search Bar -->
                    <div class="hidden lg:flex items-center bg-gray-100 dark:bg-gray-700 rounded-full px-4 py-2">
                        <i class="fas fa-search text-gray-400 dark:text-gray-500 text-sm"></i>
                        <input type="text" placeholder="Search..." class="bg-transparent border-none focus:outline-none text-sm px-2 w-48 text-gray-700 dark:text-gray-300 placeholder:text-gray-400 dark:placeholder:text-gray-500">
                        <kbd class="hidden sm:inline-block px-1.5 py-0.5 bg-white dark:bg-gray-600 border border-gray-200 dark:border-gray-600 rounded text-xs text-gray-500 dark:text-gray-400">Ctrl+K</kbd>
                    </div>
                    
                    <!-- Notifications -->
                    <div class="relative">
                        <button id="notificationBtn" class="relative w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-indigo-100 dark:hover:bg-indigo-900 transition-all">
                            <i class="fas fa-bell"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded-full animate-pulse">3</span>
                        </button>
                        
                        <div id="notificationDropdown" class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-100 dark:border-gray-700 hidden fade-in z-50">
                            <div class="p-3 border-b border-gray-100 dark:border-gray-700">
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200">Notifications</h3>
                                <p class="text-xs text-gray-400 dark:text-gray-500">You have 3 new notifications</p>
                            </div>
                            <div class="max-h-96 overflow-y-auto">
                                <div class="p-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors cursor-pointer border-b border-gray-50 dark:border-gray-700">
                                    <div class="flex gap-3">
                                        <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                            <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Vendor added successfully</p>
                                            <p class="text-xs text-gray-400 dark:text-gray-500">2 minutes ago</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors cursor-pointer border-b border-gray-50 dark:border-gray-700">
                                    <div class="flex gap-3">
                                        <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                                            <i class="fas fa-file-invoice text-blue-600 dark:text-blue-400 text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">New purchase order</p>
                                            <p class="text-xs text-gray-400 dark:text-gray-500">1 hour ago</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors cursor-pointer">
                                    <div class="flex gap-3">
                                        <div class="w-8 h-8 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center">
                                            <i class="fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-400 text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Stock low alert</p>
                                            <p class="text-xs text-gray-400 dark:text-gray-500">3 hours ago</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 border-t border-gray-100 dark:border-gray-700 text-center">
                                <a href="#" class="text-xs text-indigo-600 dark:text-indigo-400 hover:text-indigo-700">View all notifications</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- User Menu -->
                    <div class="relative">
                        <button id="userMenuBtn" class="flex items-center gap-2 focus:outline-none">
                            <div class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-full flex items-center justify-center shadow-md">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <div class="hidden sm:block text-left">
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Admin User</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">Administrator</p>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 dark:text-gray-500 text-xs hidden sm:block"></i>
                        </button>
                        
                        <div id="userDropdown" class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-100 dark:border-gray-700 hidden fade-in z-50">
                            <div class="p-3 border-b border-gray-100 dark:border-gray-700">
                                <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ Auth::guard('admin')->user() ? "Admin User" : (Auth::guard('user')->user()->full_name ?? 'User') }}</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 truncate">{{ Auth::guard('admin')->user()->email ?? (Auth::guard('user')->user()->email ?? 'user@example.com') }}</p>
                            </div>
                            <div class="py-2">
                                <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <i class="fas fa-user-circle w-4"></i> Profile
                                </a>
                                <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <i class="fas fa-cog w-4"></i> Settings
                                </a>
                                <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <i class="fas fa-shield-alt w-4"></i> Security
                                </a>
                                <div class="border-t border-gray-100 dark:border-gray-700 my-1"></div>
                                <a href="{{ Auth::guard('admin')->user() ? route('admin.logout') : route('user.logout') }}" 
                                   class="flex items-center gap-3 px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 transition-colors"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt w-4"></i> Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="p-6 fade-in">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="mt-auto border-t border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-800/50">
            <div class="px-6 py-4">
                <div class="flex justify-between items-center text-xs text-gray-500 dark:text-gray-400">
                    <div>
                        <i class="fas fa-copyright mr-1"></i> 2024 PurchasePro Management System
                    </div>
                    <div class="flex gap-4">
                        <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">About</a>
                        <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Support</a>
                        <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Privacy</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<script>
// Sidebar Toggle Function
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('mainContent');
const toggleBtn = document.getElementById('toggleSidebar');
const toggleIcon = document.getElementById('toggleIcon');
const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const sidebarOverlay = document.getElementById('sidebarOverlay');

// Load saved state
let isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

function setSidebarState(collapsed) {
    if (collapsed) {
        sidebar.classList.add('collapsed');
        mainContent.classList.add('expanded');
        if (toggleIcon) {
            toggleIcon.classList.remove('fa-chevron-left');
            toggleIcon.classList.add('fa-chevron-right');
        }
    } else {
        sidebar.classList.remove('collapsed');
        mainContent.classList.remove('expanded');
        if (toggleIcon) {
            toggleIcon.classList.remove('fa-chevron-right');
            toggleIcon.classList.add('fa-chevron-left');
        }
    }
}

function toggleSidebar() {
    isCollapsed = !isCollapsed;
    setSidebarState(isCollapsed);
    localStorage.setItem('sidebarCollapsed', isCollapsed);
    
    // Close all dropdowns when sidebar collapses
    if (isCollapsed) {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.classList.add('hidden');
        });
        document.querySelectorAll('.dropdown-icon').forEach(icon => {
            icon.style.transform = 'rotate(0deg)';
        });
    }
}

if (toggleBtn) {
    toggleBtn.addEventListener('click', toggleSidebar);
}

// Apply saved state on load
setSidebarState(isCollapsed);

// Mobile menu
if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        sidebarOverlay.classList.toggle('hidden');
        document.body.style.overflow = sidebar.classList.contains('collapsed') ? '' : 'hidden';
    });
}

if (sidebarOverlay) {
    sidebarOverlay.addEventListener('click', () => {
        sidebar.classList.add('collapsed');
        sidebarOverlay.classList.add('hidden');
        document.body.style.overflow = '';
    });
}

// Handle window resize
window.addEventListener('resize', () => {
    if (window.innerWidth >= 768) {
        sidebarOverlay?.classList.add('hidden');
        document.body.style.overflow = '';
        setSidebarState(isCollapsed);
    } else {
        sidebar.classList.add('collapsed');
        mainContent.classList.remove('expanded');
    }
});

// Dark/Light Mode Toggle
const themeToggle = document.getElementById('themeToggle');
const themeIcon = document.getElementById('themeIcon');

const savedTheme = localStorage.getItem('theme');
if (savedTheme === 'dark') {
    document.documentElement.classList.add('dark');
    themeIcon.classList.remove('fa-moon');
    themeIcon.classList.add('fa-sun');
} else if (savedTheme === 'light') {
    document.documentElement.classList.remove('dark');
    themeIcon.classList.remove('fa-sun');
    themeIcon.classList.add('fa-moon');
} else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
    document.documentElement.classList.add('dark');
    themeIcon.classList.remove('fa-moon');
    themeIcon.classList.add('fa-sun');
}

function toggleTheme() {
    if (document.documentElement.classList.contains('dark')) {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
        themeIcon.classList.remove('fa-sun');
        themeIcon.classList.add('fa-moon');
    } else {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        themeIcon.classList.remove('fa-moon');
        themeIcon.classList.add('fa-sun');
    }
}

if (themeToggle) {
    themeToggle.addEventListener('click', toggleTheme);
}

// Dropdown toggles
const notificationBtn = document.getElementById('notificationBtn');
const notificationDropdown = document.getElementById('notificationDropdown');
const userMenuBtn = document.getElementById('userMenuBtn');
const userDropdown = document.getElementById('userDropdown');

if (notificationBtn && notificationDropdown) {
    notificationBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        notificationDropdown.classList.toggle('hidden');
        userDropdown?.classList.add('hidden');
    });
}

if (userMenuBtn && userDropdown) {
    userMenuBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        userDropdown.classList.toggle('hidden');
        notificationDropdown?.classList.add('hidden');
    });
}

// Close dropdowns when clicking outside
document.addEventListener('click', (e) => {
    if (!notificationBtn?.contains(e.target)) {
        notificationDropdown?.classList.add('hidden');
    }
    if (!userMenuBtn?.contains(e.target)) {
        userDropdown?.classList.add('hidden');
    }
});

// Active link highlighting
const links = document.querySelectorAll('.sidebar-link');
links.forEach(link => {
    if (link.href === window.location.href) {
        link.classList.add('active');
    }
});

// Keyboard shortcut for search
document.addEventListener('keydown', (e) => {
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        const searchInput = document.querySelector('input[placeholder*="Search"]');
        if (searchInput) searchInput.focus();
    }
});
</script>

@include('admin.include.datatable')

</body>
</html>