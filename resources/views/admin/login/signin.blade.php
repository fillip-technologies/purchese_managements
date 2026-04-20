<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMS Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#e73c7e', // Yellow from screenshot
                        secondary: '#10b981', // Green from featured tags
                        dark: '#1f2937', // Dark gray for text
                        light: '#f3f4f6' // Light background
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar-link.active {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            color: #b45309;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .login-card {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
    </style>
</head>
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}"
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{{ session('error') }}"
        });
    </script>
@endif

@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            html: `{!! implode('<br>', $errors->all()) !!}`
        });
    </script>
@endif

<body class="bg-gray-100 font-sans">
    <!-- Login Screen -->
    <div id="login-screen"
        class="min-h-screen flex items-center justify-center
           bg-gradient-to-br from-blue-100 via-white to-blue-200 p-4">

        <div
            class="w-full max-w-md bg-white/90 backdrop-blur-lg
                shadow-2xl rounded-2xl overflow-hidden border border-gray-200">

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-700 to-blue-900 p-6">
                <h1 class="text-2xl font-bold text-white text-center tracking-wide">
                    Purchase Management
                </h1>
                <p class="text-blue-100 text-center mt-2 text-sm">
                    Manage products, bookings & users
                </p>
            </div>

            <!-- Form -->
            <div class="p-8">
                <form id="login-form" method="POST" action="{{ route('login.admin') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-gray-700 text-sm font-semibold mb-1">
                            Email Address
                        </label>

                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50
                               focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500
                               focus:border-blue-500 transition duration-200 shadow-sm"
                            placeholder="Enter your email" required autofocus>

                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password + Toggle -->
                    <div class="relative">
                        <label for="password" class="block text-gray-700 text-sm font-semibold mb-1">
                            Password
                        </label>

                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-3 pr-10 rounded-xl border border-gray-300 bg-gray-50
                               focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500
                               focus:border-blue-500 transition duration-200 shadow-sm"
                            placeholder="Enter your password" required>

                        <!-- Show/Hide -->
                        <span onclick="togglePassword()"
                            class="absolute right-3 top-9 cursor-pointer text-gray-500 hover:text-blue-600">
                            👁️
                        </span>

                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember + Forgot -->
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" id="remember" name="remember"
                                class="h-4 w-4 text-blue-600 rounded focus:ring-blue-500">
                            <span class="text-gray-600">Remember me</span>
                        </label>

                        <a href="#" class="text-blue-600 font-medium hover:underline">
                            Forgot password?
                        </a>
                    </div>

                    <!-- Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-700 to-blue-900
                           hover:from-blue-800 hover:to-blue-950
                           text-white font-semibold py-3 rounded-xl
                           shadow-lg hover:shadow-xl
                           active:scale-95 transition duration-300">
                        Sign In
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-8 py-4 text-center border-t">
                <p class="text-gray-500 text-xs">
                    © {{ date('Y') }} Fillip Technologies. All rights reserved.
                </p>
            </div>
        </div>
    </div>





    <script>
        // Toggle between login and admin panel
        document.getElementById('login-form').addEventListener('submit', function(e) {
            // e.preventDefault();
            document.getElementById('login-screen').classList.add('hidden');
            document.getElementById('admin-panel').classList.remove('hidden');
        });

        // Mobile sidebar toggle
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.querySelector('.w-64');
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('absolute');
            sidebar.classList.toggle('z-50');
        });

        // Set active state for sidebar links
        const sidebarLinks = document.querySelectorAll('.sidebar-link');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                sidebarLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });



        function togglePassword() {
            const input = document.getElementById("password");
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>
</body>

</html>
