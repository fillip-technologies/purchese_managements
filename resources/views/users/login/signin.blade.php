<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMS User Panel</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100 font-sans">

    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 via-white to-indigo-200 p-4">

        <div class="w-full max-w-md bg-white shadow-2xl rounded-2xl overflow-hidden border">

            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 p-6 text-center">
                <h1 class="text-2xl font-bold text-white">User Login</h1>
                <p class="text-indigo-100 text-sm mt-1">Access your dashboard</p>
            </div>

            <!-- Form -->
            <div class="p-8">
                <form id="loginForm" method="POST" action="{{ route('login.user') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Email</label>
                        <div class="relative">
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full mt-1 px-4 py-3 pl-10 rounded-xl border bg-gray-50 focus:ring-2 focus:ring-indigo-500 outline-none"
                                placeholder="Enter email" required>

                            <i class="fas fa-envelope absolute left-3 top-4 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                class="w-full mt-1 px-4 py-3 pl-10 pr-10 rounded-xl border bg-gray-50 focus:ring-2 focus:ring-indigo-500 outline-none"
                                placeholder="Enter password" required>

                            <i class="fas fa-lock absolute left-3 top-4 text-gray-400"></i>

                            <!-- Toggle -->
                            <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-3 text-gray-400 hover:text-indigo-600">
                                <i id="eyeIcon" class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Options -->
                    <div class="flex justify-between items-center text-sm">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="remember" class="rounded text-indigo-600">
                            <span class="text-gray-600">Remember me</span>
                        </label>

                        <a href="#" class="text-indigo-600 hover:underline font-medium">
                            Forgot?
                        </a>
                    </div>

                    <!-- Button -->
                    <button type="submit" id="loginBtn"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold shadow-lg transition">
                        <span id="btnText">Sign In</span>
                    </button>

                </form>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 text-center py-3 text-xs text-gray-500 border-t">
                © {{ date('Y') }} Fillip Technologies
            </div>

        </div>
    </div>

    <!-- Alerts -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}"
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

    <!-- Scripts -->
    <script>
        // Password toggle
        function togglePassword() {
            const input = document.getElementById("password");
            const icon = document.getElementById("eyeIcon");

            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }

        // Loading state
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('loginBtn');
            document.getElementById('btnText').innerText = "Signing in...";
            btn.disabled = true;
            btn.classList.add('opacity-70', 'cursor-not-allowed');
        });
    </script>

</body>

</html>
