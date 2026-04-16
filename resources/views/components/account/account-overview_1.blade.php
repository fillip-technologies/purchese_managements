<section x-data="{ activeTab: 'overview', sidebarOpen: false }" class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-4 gap-10">

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="overflow-y-auto fixed lg:static inset-y-0 left-0 md:w-64 w-3/4 bg-primary md:rounded-2xl shadow p-6 border-2 border-secondary md:self-start transform transition-transform duration-300 z-50">

            <div class="flex justify-end items-center">
                <button @click="sidebarOpen=false" class="lg:hidden text-gray-500">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <div class="text-center mt-6">
                <h3 class="mt-4 text-lg font-semibold text-white">{{ Auth::check() ? Auth::user()->name }}</h3>
                <p class="text-sm text-gray-300 break-all ">{{ Auth::check() ? Auth::user()->email }}</p>
            </div>

            <nav class="mt-8 space-y-2">
                <button @click="activeTab = 'overview'; sidebarOpen=false"
                    :class="activeTab === 'overview' ? 'bg-secondary text-primary font-medium' :
                        'text-secondary hover:text-gray-600 hover:bg-gray-50'"
                    class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-left">
                    <i class="fa-solid fa-user"></i> Overview
                </button>
                <button @click="activeTab = 'orders'; sidebarOpen=false"
                    :class="activeTab === 'orders' ? 'bg-secondary text-primary font-medium' :
                        'text-secondary hover:text-gray-600 hover:bg-gray-50'"
                    class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-left">
                    <i class="fa-solid fa-box"></i> Orders
                </button>
                <button @click="activeTab = 'wishlist'; sidebarOpen=false"
                    :class="activeTab === 'wishlist' ? 'bg-secondary text-primary font-medium' :
                        'text-secondary hover:text-gray-600 hover:bg-gray-50'"
                    class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-left">
                    <i class="fa-solid fa-heart"></i> Wishlist
                </button>
                <button @click="activeTab = 'address'; sidebarOpen=false"
                    :class="activeTab === 'address' ? 'bg-secondary text-primary font-medium' :
                        'text-secondary hover:text-gray-600 hover:bg-gray-50'"
                    class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-left">
                    <i class="fa-solid fa-location-dot"></i> Address
                </button>
                <button @click="activeTab = 'settings'; sidebarOpen=false"
                    :class="activeTab === 'settings' ? 'bg-secondary text-primary font-medium' :
                        'text-secondary hover:text-gray-600 hover:bg-gray-50'"
                    class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-left">
                    <i class="fa-solid fa-gear"></i> Settings
                </button>
                <a href="{{ url('logout') }}"
                    class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-left text-red-800">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
            </nav>
        </aside>

        <!-- Main Dashboard -->
        <div class="lg:col-span-3">

            <button @click="sidebarOpen=true" class="mb-4 lg:hidden bg-pink-600 text-white px-4 py-2 rounded">
                ☰ Menu
            </button>

            <div x-show="activeTab === 'overview'" x-cloak>
                <div class="space-y-8">

                    <div class="bg-primary p-6 rounded-2xl border border-rose-100 ">
                        <h2 class="text-xl font-semibold text-secondary">Welcome Back, Mohit!</h2>
                        <p class="text-sm text-secondary/90 mt-1">Here’s a quick look at your account summary.</p>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div
                            class="bg-white p-6 rounded-xl shadow border border-primary text-center hover:shadow-md transition">
                            <i class="fa-solid fa-box text-secondary text-2xl mb-2"></i>
                            <h3 class="text-lg font-semibold text-primary">12</h3>
                            <p class="text-sm text-gray-500">Orders</p>
                        </div>
                        <div
                            class="bg-white p-6 rounded-xl shadow border border-primary text-center hover:shadow-md transition">
                            <i class="fa-solid fa-heart text-secondary text-2xl mb-2"></i>
                            <h3 class="text-lg font-semibold text-primary">8</h3>
                            <p class="text-sm text-gray-500">Wishlist</p>
                        </div>
                        <div
                            class="bg-white p-6 rounded-xl shadow border border-primary text-center hover:shadow-md transition">
                            <i class="fa-solid fa-cart-plus text-secondary text-2xl mb-2"></i>
                            <h3 class="text-lg font-semibold text-primary">3</h3>
                            <p class="text-sm text-gray-500">Cart</p>
                        </div>

                    </div>

                    <!-- Recent Orders -->
                    <div class="bg-white p-6 rounded-2xl shadow border border-primary">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Orders</h3>
                        <div class="divide-y text-sm">
                            <div class="flex justify-between items-center py-3">
                                <div>
                                    <p class="font-medium text-gray-800">Diamond Ring</p>
                                    <p class="text-xs text-gray-500">Order #12345 • Placed on Jan 10, 2025</p>
                                </div>
                                <span class="text-green-600 font-medium">Delivered</span>
                            </div>
                            <div class="flex justify-between items-center py-3">
                                <div>
                                    <p class="font-medium text-gray-800">Gold Necklace</p>
                                    <p class="text-xs text-gray-500">Order #12344 • Placed on Dec 28, 2024</p>
                                </div>
                                <span class="text-yellow-600 font-medium">Shipped</span>
                            </div>
                            <div class="flex justify-between items-center py-3">
                                <div>
                                    <p class="font-medium text-gray-800">Platinum Bracelet</p>
                                    <p class="text-xs text-gray-500">Order #12343 • Placed on Dec 20, 2024</p>
                                </div>
                                <span class="text-pink-600 font-medium">Processing</span>
                            </div>
                        </div>
                        <div class="text-right mt-4">
                            <a href="#" class="text-sm text-primary hover:underline">View All Orders →</a>
                        </div>
                    </div>



                </div>

            </div>
            <div x-show="activeTab === 'wishlist'" x-cloak>
                <section x-data="wishlistComponent()" class="max-w-7xl mx-auto px-4 py-12">
                    <div class="flex items-center justify-between mb-10">
                        <h2 class="text-2xl font-semibold tracking-wide text-primary flex items-center gap-3">
                            <i class="fa-regular fa-heart text-primary"></i> My Wishlist
                        </h2>
                        <span class="text-gray-500 text-sm" x-text="wishlist.length + ' items'"></span>
                    </div>

                    <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
                        <template x-for="(item, index) in wishlist" :key="index">
                            <div class="group relative">
                                <div class="overflow-hidden rounded relative">
                                    <img :src="item.image"
                                        class="w-full h-72 object-cover group-hover:scale-105 transition duration-500 ease-in-out" />

                                    <button @click="remove(index)"
                                        class="absolute top-4 right-4 bg-white/90 backdrop-blur-md hover:bg-secondary/50 text-primary rounded-full w-10 h-10 flex items-center justify-center shadow">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>

                                <div class="mt-4 text-center">
                                    <h3 class="text-lg font-medium text-gray-800  transition" x-text="item.name"></h3>
                                    <p class="text-primary font-semibold mt-1" x-text="'₹' + item.price"></p>

                                    <div class="mt-4">
                                        <button
                                            class="w-full bg-gradient-to-r from-primary to-primary/80 hover:opacity-90 text-white font-medium py-2.5 rounded shadow-md transition">
                                            Add to Cart <i class="fa-solid fa-bag-shopping text-lg ml-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div x-show="wishlist.length === 0" class="text-center py-20 text-gray-500">
                        <i class="fa-regular fa-heart text-5xl text-primary mb-4"></i>
                        <p class="text-xl">Your wishlist is empty</p>
                        <p class="text-gray-400 mt-1">Start adding your favorite jewelry pieces <i
                                class="fa-solid fa-wand-magic-sparkles text-primary"></i></p>
                    </div>
                </section>


            </div>
            <div x-show="activeTab === 'address'" x-cloak>
                <x-account.address />
            </div>
            <div x-show="activeTab === 'orders'" x-cloak>
                <section class="bg-gray-50 py-12 px-4">
                    <div class="max-w-6xl mx-auto">
                        <h2 class="text-2xl font-semibold text-primary mb-6">My Orders</h2>

                        <div class="bg-white rounded-2xl shadow border border-primary overflow-hidden">
                            <table class="w-full text-sm text-gray-600">
                                <thead class="bg-secondary text-primary">
                                    <tr>
                                        <th class="px-6 py-4 text-left">Order ID</th>
                                        <th class="px-6 py-4 text-left">Product</th>
                                        <th class="px-6 py-4 text-left">Date</th>
                                        <th class="px-6 py-4 text-left">Status</th>
                                        <th class="px-6 py-4 text-right">Total</th>
                                        <th class="px-6 py-4 text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y">
                                    <tr>
                                        <td class="px-6 py-4 font-medium text-gray-800">#12345</td>
                                        <td class="px-6 py-4">Diamond Ring</td>
                                        <td class="px-6 py-4">Jan 10, 2025</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Delivered</span>
                                        </td>
                                        <td class="px-6 py-4 text-right font-semibold">₹1,20,000</td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="#" class="text-primary hover:underline text-sm">Contact
                                                Support</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 font-medium text-gray-800">#12344</td>
                                        <td class="px-6 py-4">Gold Necklace</td>
                                        <td class="px-6 py-4">Dec 28, 2024</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">Shipped</span>
                                        </td>
                                        <td class="px-6 py-4 text-right font-semibold">₹85,000</td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="#" class="text-primary hover:underline text-sm"></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 font-medium text-gray-800">#12343</td>
                                        <td class="px-6 py-4">Platinum Bracelet</td>
                                        <td class="px-6 py-4">Dec 20, 2024</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-700">Processing</span>
                                        </td>
                                        <td class="px-6 py-4 text-right font-semibold">₹65,000</td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="#" class="text-primary hover:underline text-sm">Contact
                                                Support</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
            <div x-show="activeTab === 'settings'" x-cloak>
                <section x-data="{ editField: null }" class="bg-gray-50 py-12">
                    <div class="max-w-4xl mx-auto px-6">
                        <h2 class="text-2xl font-semibold text-primary mb-6">Account Settings</h2>

                        <div class="bg-white rounded-xl shadow border border-rose-100 p-6 space-y-6">


                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-500">Full Name</p>
                                    <p x-show="editField !== 'name'" class="text-gray-800 font-medium">Mohit Kumar</p>
                                    <input x-show="editField === 'name'" type="text" value="Mohit Kumar"
                                        class="mt-1 w-full border px-3 py-2 rounded-md shadow-sm
                                          focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-gray-800" />

                                </div>
                                <div>
                                    <button x-show="editField !== 'name'" @click="editField = 'name'"
                                        class="text-sm text-primary hover:underline">
                                        Edit
                                    </button>
                                    <div x-show="editField === 'name'" class="flex gap-2">
                                        <button @click="editField = null"
                                            class="px-3 py-1 bg-primary text-white text-sm rounded hover:bg-primary/90">Save</button>
                                        <button @click="editField = null"
                                            class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded hover:bg-gray-300">Cancel</button>
                                    </div>
                                </div>
                            </div>

                            <hr>


                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p x-show="editField !== 'email'" class="text-gray-800 font-medium">
                                        mohit@example.com</p>
                                    <input x-show="editField === 'email'" type="email" value="mohit@example.com"
                                        class="mt-1 w-full border px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-gray-800" />
                                </div>
                                <div>
                                    <button x-show="editField !== 'email'" @click="editField = 'email'"
                                        class="text-sm text-primary hover:underline">
                                        Edit
                                    </button>
                                    <div x-show="editField === 'email'" class="flex gap-2">
                                        <button @click="editField = null"
                                            class="px-3 py-1 bg-primary text-white text-sm rounded hover:bg-primary/90">Save</button>
                                        <button @click="editField = null"
                                            class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded hover:bg-gray-300">Cancel</button>
                                    </div>
                                </div>
                            </div>

                            <hr>


                            <div x-data="{ editField: null, showPassword: false }" class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-500">Password</p>


                                    <p x-show="editField !== 'password'" class="text-gray-800 font-medium">••••••••
                                    </p>


                                    <div x-show="editField === 'password'" class="relative">
                                        <input :type="showPassword ? 'text' : 'password'" value="12345678"
                                            class="mt-1 w-full border px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-gray-800 pr-10" />


                                        <button type="button" @click="showPassword = !showPassword"
                                            class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-gray-700">
                                            <i x-show="!showPassword" class="fa fa-eye"></i>
                                            <i x-show="showPassword" class="fa fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>

                                <div>
                                    <button x-show="editField !== 'password'" @click="editField = 'password'"
                                        class="text-sm text-primary hover:underline">
                                        Edit
                                    </button>
                                    <div x-show="editField === 'password'" class="flex gap-2">
                                        <button @click="editField = null"
                                            class="px-3 py-1 bg-primary text-white text-sm rounded hover:bg-primary/90">Save</button>
                                        <button @click="editField = null"
                                            class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded hover:bg-gray-300">Cancel</button>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="flex items-center justify-start mt-5 px-2">

                            <a href="{{ url('/forget-pass') }}" class="text-primary hover:underline">
                                Forgot Password?
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
<script>
    function wishlistComponent() {
        return {
            wishlist: [{
                    name: "Anniversary Banner",
                    price: "12,999",
                    image: "/images/product-images/7x4anniversary1.jpg"
                },
                {
                    name: "Couple Outfits",
                    price: "7,499",
                    image: "/images/product-images/couple-standing-with-gift-greeting-card.jpg"
                },
                {
                    name: "Coffee Mug",
                    price: "2,999",
                    image: "/images/product-images/high-angle-boss-s-day-arrangement-with-cup-gift.jpg"
                },
                {
                    name: "Office Decor Set",
                    price: "15,999",
                    image: "/images/product-images/front-view-office-desk-with-laptop-chair.jpg"
                }
            ],
            remove(index) {
                this.wishlist.splice(index, 1);
            }
        }
    }
</script>
