<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb', // blue (premium feel)
                        secondary: '#10b981',
                        dark: '#111827',
                    }
                }
            }
        }
    </script>

    <style>
        .sidebar-link.active {
            background: #eff6ff;
            color: #2563eb;
            border-left: 3px solid #2563eb;
        }

        .card {
            @apply bg-white rounded-2xl shadow-sm border border-gray-100;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col fixed h-full">

        <!-- Logo -->
        <div class="p-5 border-b flex items-center gap-3">
            <div class="w-10 h-10 bg-primary text-white rounded-xl flex items-center justify-center font-bold">
                PMS
            </div>
            <div>
                <h2 class="font-semibold text-gray-800">Management</h2>
                <p class="text-xs text-gray-400">Purchase Management</p>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="flex-1 overflow-y-auto">
            @include('admin.include.sidebar')
        </div>

        <!-- User -->
        <div class="p-4 border-t flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                <i class="fas fa-user text-gray-500"></i>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium text-gray-700">Admin</p>
                <p class="text-xs text-gray-400 truncate">
                    {{ Auth::user()->email ?? "" }}
                </p>
            </div>
            <a href="{{ route('admin.logout') }}" class="text-gray-400 hover:text-red-500">
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

</div>

<script>
    // Active link
    const links = document.querySelectorAll('.sidebar-link');
    links.forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add('active');
        }
    });
</script>

@include('admin.include.datatable')

</body>
</html>
