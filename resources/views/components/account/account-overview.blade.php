<section x-data="{ activeTab: 'overview', sidebarOpen: false }" class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-4 gap-10">
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
                class="fixed lg:static inset-y-0 left-0 md:w-64 w-3/4 bg-white md:rounded-2xl shadow p-6 border border-rose-100 md:self-start transform transition-transform duration-300">

                <div class="flex justify-end items-center">
                    <button @click="sidebarOpen=false" class="lg:hidden text-gray-500">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>

                <div class="text-center mt-6">
                    <h3 class="mt-4 text-lg font-semibold text-pink-800">{{ Auth::check() ? Auth::user()->name : '' }}
                    </h3>
                    <p class="text-sm text-gray-500">{{ Auth::check() ? Auth::user()->email : '' }}</p>
                </div>

                <nav class="mt-8 space-y-2">
                    <button @click="activeTab = 'overview'; sidebarOpen=false"
                        :class="activeTab === 'overview' ? 'bg-pink-50 text-pink-600 font-medium' :
                            'text-pink-600 hover:bg-gray-50'"
                        class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-left">
                        <i class="fa-solid fa-user"></i> Overview
                    </button>
                    <button @click="activeTab = 'orders'; sidebarOpen=false"
                        :class="activeTab === 'orders' ? 'bg-pink-50 text-pink-600 font-medium' :
                            'text-pink-600 hover:bg-gray-50'"
                        class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-left">
                        <i class="fa-solid fa-box"></i> Orders
                    </button>
                    <button @click="activeTab = 'wishlist'; sidebarOpen=false"
                        :class="activeTab === 'wishlist' ? 'bg-pink-50 text-pink-600 font-medium' :
                            'text-pink-600 hover:bg-gray-50'"
                        class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-left">
                        <i class="fa-solid fa-heart"></i> Wishlist
                    </button>

                    <button @click="activeTab = 'settings'; sidebarOpen=false"
                        :class="activeTab === 'settings' ? 'bg-pink-50 text-pink-600 font-medium' :
                            'text-pink-600 hover:bg-gray-50'"
                        class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-left">
                        <i class="fa-solid fa-gear"></i> Settings
                    </button>
                    <a href="{{ url('logout') }}"
                        :class="activeTab === 'logout' ? 'bg-pink-50 text-pink-600 font-medium' :
                            'text-pink-600 hover:bg-gray-50'"
                        class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-left">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="ml-2">Logout</span>
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

                        <div class="bg-gradient-to-r from-pink-100 to-rose-50 p-6 rounded-2xl border border-rose-100 ">
                            <h2 class="text-xl font-semibold text-gray-800">Welcome Back,
                                {{ Auth::check() ? Auth::user()->name : '' }}!</h2>
                            <p class="text-sm text-gray-600 mt-1">Here’s a quick look at your account summary.</p>
                        </div>

                        <!-- Stats Cards -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div
                                class="bg-white p-6 rounded-xl shadow border border-pink-600 text-center hover:shadow-md transition">
                                <i class="fa-solid fa-box text-pink-600 text-2xl mb-2"></i>
                                @php
                                    $countOrder = 0;
                                    if (Auth::check()) {
                                        $userId = Auth::id();
                                        $countOrder = App\Models\Order::where('user_id', $userId)->count();
                                    }
                                @endphp
                                <h3 class="text-lg font-semibold text-pink-800">{{ $countOrder }}</h3>
                                <p class="text-sm text-pink-500">Orders</p>
                            </div>
                            <div
                                class="bg-white p-6 rounded-xl shadow border border-pink-600 text-center hover:shadow-md transition">
                                <i class="fa-solid fa-heart text-pink-600 text-2xl mb-2"></i>
                                <h3 class="text-lg font-semibold text-gray-800">
                                    {{ App\Models\WishList::where('user_id', Auth::check() ? Auth::user()->id : '')->count() }}
                                </h3>
                                <p class="text-sm text-pink-500">Wishlist</p>
                            </div>
                            <div
                                class="bg-white p-6 rounded-xl shadow border border-pink-600 text-center hover:shadow-md transition">
                                <i class="fa-solid fa-cart-plus text-pink-600 text-2xl mb-2"></i>
                                @php
                                    $cartItems = App\Models\CartItem::where('user_id', $userId)->count();
                                @endphp
                                <h3 class="text-lg font-semibold text-gray-800">{{ $cartItems }}</h3>
                                <p class="text-sm text-pink-500">Cart</p>
                            </div>

                        </div>

                        <!-- Recent Orders -->
                        <div class="bg-white p-6 rounded-2xl shadow border border-rose-100">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Orders</h3>
                            <div class="divide-y text-sm">
                                <div class="flex justify-between items-center py-3">
                                    <div>
                                        <p class="font-medium text-gray-800">Diamond Ring</p>
                                        <p class="text-xs text-gray-500">Order #12345 • Placed on Jan 10, 2025</p>
                                    </div>
                                    <span class="text-pink-600 font-medium">Delivered</span>
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
                                <a href="#" class="text-sm text-pink-600 hover:underline">View All Orders →</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-show="activeTab === 'wishlist'" x-cloak>
                    <section x-data="wishlistComponent()" class="max-w-7xl mx-auto px-4 py-12">
                        <div class="flex items-center justify-between mb-10">
                            <h2 class="text-2xl font-semibold tracking-wide text-gray-800 flex items-center gap-3">
                                <i class="fa-regular fa-heart text-pink-500"></i> My Wishlist
                            </h2>
                            <span class="text-gray-500 text-sm" x-text="wishlist.length + ' items'"></span>
                        </div>

                        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
                            <template x-for="(item, index) in wishlist" :key="item.id">
                                <div class="group relative border rounded-lg shadow hover:shadow-lg transition p-3">
                                    <div class="overflow-hidden rounded relative">
                                        <img :src="item.image" alt=""
                                            class="w-full h-72 object-cover group-hover:scale-105 transition duration-500 ease-in-out" />

                                        {{-- ❌ Remove Button --}}
                                        <button @click="removeItem(item.id, index)"
                                            class="absolute top-4 right-4 bg-white/90 backdrop-blur-md hover:bg-pink-100 text-pink-600 rounded-full w-10 h-10 flex items-center justify-center shadow">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <h3 class="text-lg font-medium text-gray-800" x-text="item.name"></h3>
                                        <p class="text-pink-600 font-semibold mt-1" x-text="'₹' + item.price"></p>

                                        <div class="mt-4">
                                            {{-- ✅ Add to Cart --}}
                                            @if (Auth::check())
                                                <form :action="'{{ route('cart.add') }}'" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                                    {{-- ❗ Use item.id instead of $products->id --}}
                                                    <input type="hidden" name="product_id" :value="item.id">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit"
                                                        class="block text-center w-full bg-gradient-to-r from-pink-400 to-rose-300 hover:opacity-90 text-white font-medium py-2.5 rounded shadow-md transition">
                                                        Add to Cart
                                                        <i class="fa-solid fa-bag-shopping text-lg ml-2"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <a href="{{ route('login') }}"
                                                    class="block text-center w-full bg-gradient-to-r from-pink-400 to-rose-300 hover:opacity-90 text-white font-medium py-2.5 rounded shadow-md transition">
                                                    Login to Add to Cart
                                                    <i class="fa-solid fa-right-to-bracket text-lg ml-2"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div x-show="wishlist.length === 0" class="text-center py-20 text-gray-500">
                            <i class="fa-regular fa-heart text-5xl text-pink-400 mb-4"></i>
                            <p class="text-xl">Your wishlist is empty</p>
                            <p class="text-gray-400 mt-1">Start adding your favorite jewelry pieces <i
                                    class="fa-solid fa-wand-magic-sparkles"></i></p>
                        </div>
                    </section>
                </div>
                <div x-show="activeTab === 'address'" x-cloak>
                    <section x-data="{ showForm: false }" class="bg-gray-50 py-12">
                        <div class="max-w-6xl mx-auto px-6">
                            <h2 class="text-2xl font-semibold text-gray-800 mb-6">My Addresses</h2>

                            <!-- Saved Addresses -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-show="!showForm">
                                <!-- Address Card -->
                                <div
                                    class="bg-white rounded-xl shadow border border-rose-100 p-6 hover:shadow-md transition">
                                    <h3 class="font-semibold text-gray-800 mb-2">Home</h3>
                                    <p class="text-sm text-gray-600 mb-3">
                                        123 Jewellery Street, Patna, Bihar - 803110
                                    </p>
                                    <div class="flex gap-3 text-sm">
                                        <button
                                            class="px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition">
                                            Edit
                                        </button>
                                        <button
                                            class="px-4 py-2 border border-gray-300 text-gray-600 rounded-lg hover:bg-gray-100 transition">
                                            Remove
                                        </button>
                                    </div>
                                </div>

                                <!-- Address Card -->
                                <div
                                    class="bg-white rounded-xl shadow border border-rose-100 p-6 hover:shadow-md transition">
                                    <h3 class="font-semibold text-gray-800 mb-2">Office</h3>
                                    <p class="text-sm text-gray-600 mb-3">
                                        56 Coworking Studio, Patna, Bihar - 800001
                                    </p>
                                    <div class="flex gap-3 text-sm">
                                        <button
                                            class="px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition">
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
                                    class="px-5 py-3 w-full md:w-auto bg-gradient-to-r from-pink-500 to-rose-400 text-white rounded-lg shadow hover:opacity-90 transition">
                                    <i class="fa-solid fa-plus mr-2"></i> Add New Address
                                </button>
                            </div>


                        </div>
                    </section>
                </div>
                <div x-show="activeTab === 'orders'" x-cloak>

                    {{-- <section class="bg-gray-50 py-12 px-4">
                        <div class="max-w-6xl mx-auto">
                            <h2 class="text-2xl font-semibold text-gray-800 mb-6">My Orders</h2>

                            <div class="bg-white rounded-2xl shadow border border-pink-100 overflow-hidden">
                                <table class="w-full text-sm text-gray-600">
                                    <thead class="bg-pink-50 text-gray-800">
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
                                        @php
                                            $index = 1;
                                        @endphp
                                        @foreach (App\Models\OrderItem::with('product')->get() as $orderData)
                                            @php
                                                $proId = $orderData->order_id;
                                                $orders = App\Models\Order::where('id', $proId)->get();
                                            @endphp
                                            <tr>
                                                <td class="px-6 py-4 font-medium text-gray-800">{{ $index++ }}
                                                </td>
                                                <td class="px-6 py-4">{{ $orderData->product->name }}</td>
                                                <td class="px-6 py-4">{{ $orderData->created_at->format('M,d,Y') }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <span
                                                        class="px-3 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-700">{{ $orders->first()->status }}</span>
                                                </td>
                                                <td class="px-6 py-4 text-right font-semibold">
                                                    ₹{{ $orderData->product->price }}</td>
                                                <td class="px-6 py-4 text-right">
                                                    <a href="#"
                                                        class="text-pink-600 hover:underline text-sm"></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section> --}}
                </div>
                <div x-show="activeTab === 'settings'" x-cloak>
                    <section x-data="{ editField: null }" class="bg-gray-50 py-12">
                        <div class="max-w-4xl mx-auto px-6">
                            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Account Settings</h2>
                            <div class="bg-white rounded-xl shadow border border-rose-100 p-6 space-y-6">

                                @php
                                    $userdata = App\Models\User::where('id', $userId)->first();
                                @endphp
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-sm text-gray-500">Full Name</p>
                                        <p x-show="editField !== 'name'" class="text-gray-800 font-medium">
                                            {{ $userdata->name }}
                                        </p>
                                        <input x-show="editField === 'name'" type="text"
                                            value="Mohit Kumar"class="mt-1 w-full border px-3 py-2 rounded-md shadow-smfocus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent text-gray-800" />

                                    </div>
                                    <div>

                                        <div x-show="editField === 'name'" class="flex gap-2">
                                            <button @click="editField = null"
                                                class="px-3 py-1 bg-pink-600 text-white text-sm rounded hover:bg-pink-700">Save</button>
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
                                            {{ $userdata->email }}</p>
                                        <input x-show="editField === 'email'" type="email" value="mohit@example.com"
                                            class="mt-1 w-full border px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent text-gray-800" />
                                    </div>
                                    <div>

                                        <div x-show="editField === 'email'" class="flex gap-2">
                                            <button @click="editField = null"
                                                class="px-3 py-1 bg-pink-600 text-white text-sm rounded hover:bg-pink-700">Save</button>
                                            <button @click="editField = null"
                                                class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded hover:bg-gray-300">Cancel</button>
                                        </div>
                                    </div>
                                </div>

                                <hr>


                                <div x-data="{ editField: null, showPassword: false }" class="flex justify-between items-center">
                                    <div>
                                        <p class="text-sm text-gray-500">Password</p>


                                        <p x-show="editField !== 'password'" class="text-gray-800 font-medium">
                                            ••••••••
                                        </p>


                                        <div x-show="editField === 'password'" class="relative">
                                            <input :type="showPassword ? 'text' : 'password'" value="12345678"
                                                class="mt-1 w-full border px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent text-gray-800 pr-10" />


                                            <button type="button" @click="showPassword = !showPassword"
                                                class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-gray-700">
                                                <i x-show="!showPassword" class="fa fa-eye"></i>
                                                <i x-show="showPassword" class="fa fa-eye-slash"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div>

                                        <div x-show="editField === 'password'" class="flex gap-2">
                                            <button @click="editField = null"
                                                class="px-3 py-1 bg-pink-600 text-white text-sm rounded hover:bg-pink-700">Save</button>
                                            <button @click="editField = null"
                                                class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded hover:bg-gray-300">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                                {{-- <button id="openModal" class="bg-pink-900 p-2 rounded-md text-white hover:bg-pink-700">
                                    Edit
                                </button> --}}

                            </div>


                            <div class="flex items-center justify-start mt-5 px-2">

                                <a href="{{ route('forget.password') }}" class="text-pink-600 hover:underline">
                                    Forgot Password?
                                </a>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </section>
<div id="modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-2xl shadow-lg w-96">
      <h2 class="text-xl font-semibold mb-4">Edit Details</h2>

      <form>
        <label class="block mb-2 text-gray-700">Name</label>
        <input type="text" class="w-full border border-gray-300 rounded-md p-2 mb-4" placeholder="Enter name">

        <label class="block mb-2 text-gray-700">Email</label>
        <input type="email" class="w-full border border-gray-300 rounded-md p-2 mb-4" placeholder="Enter email">

        <div class="flex justify-end gap-3">
          <button type="button" id="closeModal" class="bg-gray-400 text-white px-4 py-2 rounded-md hover:bg-gray-500">
            Close
          </button>
          <button type="submit" class="bg-pink-900 text-white px-4 py-2 rounded-md hover:bg-pink-700">
            Save
          </button>
        </div>
      </form>
    </div>
  </div>


@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('fsuc'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            title: "Email Send!",
            text: "{{ session('fsuc') }}",
            icon: "success",
            confirmButtonText: "OK"
        });
    });
</script>
@endif

<script>
    function wishlistComponent() {
        return {
            wishlist: @json($products),

            async removeItem(productId, index) {
                if (confirm('Remove this product from your wishlist?')) {
                    try {
                        const response = await fetch("{{ route('wishlist.remove') }}", {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                product_id: productId
                            }),
                        });

                        const data = await response.json();
                        if (data.success) {
                            this.wishlist.splice(index, 1);
                        } else {
                            alert('Failed to remove item.');
                        }
                    } catch (error) {
                        console.error(error);
                        alert('Error removing product.');
                    }
                }
            }
        }
    }

</script>
