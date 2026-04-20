<nav class="mt-6 flex-1 overflow-y-auto scrollbar-thin" id="sidebarNav">
    
    <!-- Navigation Heading -->
    <div class="px-5 mb-4 transition-colors duration-200">
        <p class="text-[11px] uppercase text-gray-400 dark:text-gray-500 font-semibold tracking-widest sidebar-text">Navigation</p>
    </div>

    <!-- Dashboard Link -->
    <a href="{{ Auth::guard('admin')->user() ? url('/admin/dashboard') : route('user.dashboard') }}"
        class="sidebar-link flex items-center gap-3 mx-3 px-4 py-2.5 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-200 group relative">
        
        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-indigo-600 rounded-r opacity-0 group-hover:opacity-100 transition-all duration-200"></span>
        
        <i class="fas fa-chart-line w-5 text-gray-400 dark:text-gray-500 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors"></i>
        <span class="sidebar-text">Dashboard</span>
    </a>

    @if (Auth::guard('admin')->user())
        <div class="mx-4 my-3 border-t border-gray-100 dark:border-gray-700 sidebar-text"></div>

        <!-- Master Setup Dropdown -->
        <div class="dropdown-container mx-3 mb-1">
            <button onclick="toggleDropdown(this)" 
                class="dropdown-btn w-full flex items-center justify-between cursor-pointer px-4 py-2.5 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-900/30 transition-all duration-200 group">
                <div class="flex items-center gap-3">
                    <i class="fas fa-users w-5 text-gray-400 dark:text-gray-500 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors"></i>
                    <span class="sidebar-text">Master Setup</span>
                </div>
                <i class="dropdown-icon fas fa-chevron-down text-xs text-gray-400 dark:text-gray-500 transition-transform duration-200 sidebar-text"></i>
            </button>
            <div class="dropdown-menu hidden pl-11 mt-1 space-y-1">
                <a href="{{ route('users') }}" class="flex items-center gap-2 py-2 text-sm text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                    <i class="fas fa-circle text-[6px]"></i>
                    <span class="sidebar-text">Add Users</span>
                </a>
                <a href="{{ route('vendors.index') }}" class="flex items-center gap-2 py-2 text-sm text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                    <i class="fas fa-circle text-[6px]"></i>
                    <span class="sidebar-text">Add Vendors</span>
                </a>
                <a href="{{ route('add.clients') }}" class="flex items-center gap-2 py-2 text-sm text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                    <i class="fas fa-circle text-[6px]"></i>
                    <span class="sidebar-text">Add Clients</span>
                </a>
                <a href="{{ route('add.addproduct') }}" class="flex items-center gap-2 py-2 text-sm text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                    <i class="fas fa-circle text-[6px]"></i>
                    <span class="sidebar-text">Add Products</span>
                </a>
            </div>
        </div>

        <!-- Vendors Dropdown -->
        <div class="dropdown-container mx-3 mb-1">
            <button onclick="toggleDropdown(this)" 
                class="dropdown-btn w-full flex items-center justify-between cursor-pointer px-4 py-2.5 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-900/30 transition-all duration-200 group">
                <div class="flex items-center gap-3">
                    <i class="fas fa-layer-group w-5 text-gray-400 dark:text-gray-500 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors"></i>
                    <span class="sidebar-text">Vendors</span>
                </div>
                <i class="dropdown-icon fas fa-chevron-down text-xs text-gray-400 dark:text-gray-500 transition-transform duration-200 sidebar-text"></i>
            </button>
            <div class="dropdown-menu hidden pl-11 mt-1 space-y-1">
                <a href="{{ route('add.vendor.product') }}" class="flex items-center gap-2 py-2 text-sm text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                    <i class="fas fa-circle text-[6px]"></i>
                    <span class="sidebar-text">Add Vendors Products</span>
                </a>
            </div>
        </div>

        <!-- Requisition Lists Link -->
        <div class="mx-3 mt-2">
            <a href="{{ route('list.requisition') }}"
                class="flex items-center gap-3 px-4 py-2.5 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-200 group">
                <i class="fas fa-list w-5 text-gray-400 dark:text-gray-500 group-hover:text-indigo-600 dark:group-hover:text-indigo-400"></i>
                <span class="sidebar-text">Requisition Lists</span>
            </a>
        </div>
    @else
        <!-- User Dropdown -->
        <div class="dropdown-container mx-3 mt-4">
            <button onclick="toggleDropdown(this)" 
                class="dropdown-btn w-full flex items-center justify-between cursor-pointer px-4 py-2.5 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-900/30 transition-all duration-200 group">
                <div class="flex items-center gap-3">
                    <i class="fas fa-layer-group w-5 text-gray-400 dark:text-gray-500 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors"></i>
                    <span class="sidebar-text">Purchase Requisition</span>
                </div>
                <i class="dropdown-icon fas fa-chevron-down text-xs text-gray-400 dark:text-gray-500 transition-transform duration-200 sidebar-text"></i>
            </button>
            <div class="dropdown-menu hidden pl-11 mt-1 space-y-1">
                <a href="#" class="flex items-center gap-2 py-2 text-sm text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                    <i class="fas fa-circle text-[6px]"></i>
                    <span class="sidebar-text">My Requisitions</span>
                </a>
                <a href="#" class="flex items-center gap-2 py-2 text-sm text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                    <i class="fas fa-circle text-[6px]"></i>
                    <span class="sidebar-text">New Requisition</span>
                </a>
            </div>
        </div>
    @endif
</nav>

<script>
// Dropdown toggle function
function toggleDropdown(button) {
    // Check if sidebar is collapsed - don't allow dropdown toggling
    const sidebar = document.getElementById('sidebar');
    if (sidebar && sidebar.classList.contains('collapsed')) {
        return;
    }
    
    const container = button.closest('.dropdown-container');
    const menu = container.querySelector('.dropdown-menu');
    const icon = button.querySelector('.dropdown-icon');
    
    // Close other dropdowns
    document.querySelectorAll('.dropdown-container').forEach(cont => {
        if (cont !== container) {
            const otherMenu = cont.querySelector('.dropdown-menu');
            const otherIcon = cont.querySelector('.dropdown-icon');
            if (otherMenu && !otherMenu.classList.contains('hidden')) {
                otherMenu.classList.add('hidden');
                if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
            }
        }
    });
    
    // Toggle current dropdown
    menu.classList.toggle('hidden');
    if (icon) {
        icon.style.transform = menu.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
    }
    
    // Save state to localStorage
    saveDropdownStates();
}

// Save dropdown states
function saveDropdownStates() {
    const dropdownStates = {};
    document.querySelectorAll('.dropdown-container').forEach((container, index) => {
        const menu = container.querySelector('.dropdown-menu');
        dropdownStates[`dropdown_${index}`] = !menu?.classList.contains('hidden');
    });
    localStorage.setItem('dropdownStates', JSON.stringify(dropdownStates));
}

// Load dropdown states
function loadDropdownStates() {
    // Don't load dropdown states if sidebar is collapsed
    const sidebar = document.getElementById('sidebar');
    if (sidebar && sidebar.classList.contains('collapsed')) {
        return;
    }
    
    const savedStates = localStorage.getItem('dropdownStates');
    if (savedStates) {
        const states = JSON.parse(savedStates);
        document.querySelectorAll('.dropdown-container').forEach((container, index) => {
            const menu = container.querySelector('.dropdown-menu');
            const icon = container.querySelector('.dropdown-icon');
            if (states[`dropdown_${index}`] && menu) {
                menu.classList.remove('hidden');
                if (icon) icon.style.transform = 'rotate(180deg)';
            }
        });
    }
}

// Close all dropdowns (used when sidebar collapses)
function closeAllDropdowns() {
    document.querySelectorAll('.dropdown-menu').forEach(menu => {
        menu.classList.add('hidden');
    });
    document.querySelectorAll('.dropdown-icon').forEach(icon => {
        icon.style.transform = 'rotate(0deg)';
    });
    // Clear saved states when collapsed
    localStorage.removeItem('dropdownStates');
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    loadDropdownStates();
});

// Listen for sidebar collapse/expand events
const observer = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
        if (mutation.attributeName === 'class') {
            const sidebar = document.getElementById('sidebar');
            if (sidebar && sidebar.classList.contains('collapsed')) {
                closeAllDropdowns();
            } else {
                loadDropdownStates();
            }
        }
    });
});

const sidebarElement = document.getElementById('sidebar');
if (sidebarElement) {
    observer.observe(sidebarElement, { attributes: true });
}
</script>

<style>
/* Custom scrollbar for sidebar */
.scrollbar-thin::-webkit-scrollbar {
    width: 5px;
}

.scrollbar-thin::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.scrollbar-thin::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}

.scrollbar-thin::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Dark mode scrollbar */
.dark .scrollbar-thin::-webkit-scrollbar-track {
    background: #1f2937;
}

.dark .scrollbar-thin::-webkit-scrollbar-thumb {
    background: #4b5563;
}

.dark .scrollbar-thin::-webkit-scrollbar-thumb:hover {
    background: #6b7280;
}

/* Smooth transitions */
.sidebar-link,
.dropdown-btn,
.dropdown-menu a {
    transition: all 0.2s ease;
}

/* Active link styling */
.sidebar-link.active {
    background-color: #eef2ff;
    color: #4f46e5;
}

.dark .sidebar-link.active {
    background-color: rgba(79, 70, 229, 0.2);
    color: #818cf8;
}

.sidebar-link.active i {
    color: #4f46e5;
}

.dark .sidebar-link.active i {
    color: #818cf8;
}

/* Dropdown menu animation */
.dropdown-menu {
    animation: slideDown 0.2s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Sidebar collapsed styles */
.sidebar.collapsed .sidebar-text {
    display: none !important;
}

.sidebar.collapsed .sidebar-link {
    justify-content: center !important;
    padding: 0.625rem !important;
}

.sidebar.collapsed .sidebar-link i {
    margin-right: 0 !important;
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

.sidebar.collapsed .dropdown-icon {
    display: none !important;
}

/* Tooltip for collapsed sidebar */
.sidebar.collapsed .sidebar-link:hover::after {
    content: attr(data-tooltip);
    position: fixed;
    left: 90px;
    background: #1f2937;
    color: white;
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 12px;
    white-space: nowrap;
    z-index: 1000;
    pointer-events: none;
}

.dark .sidebar.collapsed .sidebar-link:hover::after {
    background: #374151;
}

/* Responsive */
@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
        position: fixed !important;
        z-index: 1000;
    }
    
    .sidebar.mobile-open {
        transform: translateX(0);
    }
    
    .main-content {
        margin-left: 0 !important;
    }
}
</style>