<div class="flex items-center justify-center py-16 bg-cover bg-center bg-no-repeat px-6"
    style="background-image: url('/images/bg.jpg');">
    <div class="w-full max-w-md bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-8">
        <!-- Title -->
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Hey User</h2>

        <!-- Form -->
        <form class="space-y-5" action="{{ route('store.user') }}" method="POST">
            @csrf
            <div>
                <label class="block text-gray-600 text-sm mb-2">Name</label>
                <input type="name" placeholder="Enter your name" name="name"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:outline-none" />
                    @error('name')
                    <span class="text-red-700">{{$message}}</span>
                    @enderror
            </div>

            <div>
                <label class="block text-gray-600 text-sm mb-2">Email Address</label>
                <input type="email" placeholder="Enter your email" name="email"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:outline-none" />
                    @error('email')
                    <span class="text-red-700">{{$message}}</span>
                    @enderror
            </div>
              <div>
                <label class="block text-gray-600 text-sm mb-2">Phone</label>
                <input type="number" placeholder="Enter your number" name="phone"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:outline-none" />
                    @error('phone')
                    <span class="text-red-700">{{$message}}</span>
                    @enderror
            </div>

            <div>
                <label class="block text-gray-600 text-sm mb-2">Password</label>
                <input type="password" placeholder="Enter your password" name="password"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:outline-none" />
                    @error('password')
                    <span class="text-red-700">{{$message}}</span>
                    @enderror
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center space-x-2">
                    <input
                      type="checkbox"
                      class="rounded accent-primary hover:accent-secondary focus:accent-secondary"
                    />
                    <span class="text-gray-600">Remember me</span>
                </label>

            </div>

            <button type="submit"
                class="block text-center w-full py-2 px-4 bg-primary text-white rounded shadow-md hover:bg-primary/90 transition duration-300">
                Register
        </button>
        </form>


        <!-- Register -->
        <p class="text-center text-sm text-gray-600 mt-6">
            Already have an account?
            <a href="{{route('login') }}" class="text-primary hover:underline">Login</a>
        </p>
    </div>
</div>

