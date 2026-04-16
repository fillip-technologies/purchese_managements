<section x-data="{ showForm: false }" class="bg-gray-50 py-12">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-2xl font-semibold text-primary mb-6">My Addresses</h2>

        <!-- Saved Addresses -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-show="!showForm">
            <!-- Address Card -->
            <div class="bg-white rounded-xl shadow border border-primary p-6 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-800 mb-2">Home</h3>
                <p class="text-sm text-gray-600 mb-3">
                    123 Jewellery Street, Patna, Bihar - 803110
                </p>
                <div class="flex gap-3 text-sm">
                    <button class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition">
                        Edit
                    </button>
                    <button
                        class="px-4 py-2 border border-gray-300 text-gray-600 rounded-lg hover:bg-gray-100 transition">
                        Remove
                    </button>
                </div>
            </div>

            <!-- Address Card -->
            <div class="bg-white rounded-xl shadow border border-primary p-6 hover:shadow-md transition">
                <h3 class="font-semibold text-gray-800 mb-2">Office</h3>
                <p class="text-sm text-gray-600 mb-3">
                    56 Coworking Studio, Patna, Bihar - 800001
                </p>
                <div class="flex gap-3 text-sm">
                    <button class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition">
                        Edit
                    </button>
                    <button
                        class="px-4 py-2 border border-gray-300 text-gray-600 rounded-lg hover:bg-gray-100 transition">
                        Remove
                    </button>
                </div>
            </div>
        </div>

        <!-- Add New Address Button -->
        <div class="mt-6" x-show="!showForm">
            <button @click="showForm = true"
                class="px-5 py-3 w-full md:w-auto bg-gradient-to-r from-secondary to-secondary/80 text-primary rounded-lg shadow hover:opacity-90 transition">
                <i class="fa-solid fa-plus mr-2"></i> Add New Address
            </button>
        </div>

        <!-- Address Form -->
        <div id="addressForm" x-show="showForm" x-cloak
            class="mt-8 bg-white p-6 rounded-xl shadow border border-rose-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Add New Address</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="firstName" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" id="firstName" name="firstName" value="Mohit"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors" />
                </div>
                <div>
                    <label for="lastName" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" id="lastName" name="lastName" value="Kumar"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors" />
                </div>
            </div>

            <div class="mt-4">
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                <input type="text" id="address" name="address" value="123 Main Street"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors" />
            </div>

            <div class="mt-4">
                <label for="apartment" class="block text-sm font-medium text-gray-700 mb-1">Apartment, suite, etc.
                    (optional)</label>
                <input type="text" id="apartment" name="apartment" value="Apartment 4B"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                    <input type="text" id="city" name="city" value="Patna"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors" />
                </div>
                <div>
                    <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State</label>
                    <select id="state" name="state"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                        <option value="BR" selected>Bihar</option>
                    </select>
                </div>
                <div>
                    <label for="zipCode" class="block text-sm font-medium text-gray-700 mb-1">ZIP Code</label>
                    <input type="text" id="zipCode" name="zipCode" value="800020"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div class="">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="tel" id="phone" name="phone" value="9856303568"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors" />
                </div>
                <div>
                    <label for="address_type" class="block text-sm font-medium text-gray-700 mb-1">Address Type</label>
                    <input type="text" id="address_type" name="address_type" value="Home"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors" />
                </div>
            </div>

            <div class="flex space-x-3 mt-6">
                <button @click="showForm = false"
                    class="bg-primary text-white px-4 py-2 rounded-md hover:bg-primary/90 transition-colors font-medium">
                    Save Address
                </button>
                <button @click="showForm = false"
                    class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300 transition-colors font-medium">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</section>
