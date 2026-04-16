<?php

namespace App\Http\Controllers;

use App\Mail\Forgetpasswordmail;
use App\Mail\OrderEmail;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function users(){
        return view('admin.mastersetup.users.createUser');
    }

     public function vendors(){
        return view('admin.mastersetup.vendors.addVendor');
    }

     public function clients(){
        return view('admin.mastersetup.clients.addClient');
    }

    public function add_product(){
        return view('admin.mastersetup.products.addProduct');
    }
    public function vendor_product(){
        return view('admin.mastersetup.products.venderProducts');
    }

    public function loginPage()
    {
        return view('pages.login');

    }

    public function registerPage()
    {
        return view('pages.register');

    }

    public function productDescriptionPage($slugs)
    {
        $product_details = Product::with(['variants', 'category'])
            ->where('slug', $slugs)
            ->firstOrFail();

        return view('pages.product-description', compact('product_details'));

    }

    public function wishlistPage()
    {
        $userId = Auth::check() ? Auth::id() : null;
        $wishListData = WishList::where('user_id', $userId)
            ->pluck('product_id')
            ->toArray();
        $product = Product::whereIn('id', $wishListData)->get();

        return view('pages.wishlist', compact('product'));
    }

    public function cartPage()
    {
        $cartItems = CartItem::with('product')->where('user_id', Auth::check() ? Auth::user()->id : '')->get();

        return view('pages.cart', compact('cartItems'));

    }

    // public function checkoutPage()
    // {
    //     return view('pages.checkout');

    // }

    public function completeOrderPage()
    {
        return view('pages.complete-order');

    }

    public function viewProductPage()
    {

        $product = Product::with(['variants', 'category'])->paginate(10);

        return view('pages.view-product', compact('product'));

    }

    public function accountOverviewPage()
    {
        $userId = Auth::check() ? Auth::id() : null;
        $wishListData = WishList::where('user_id', $userId)
            ->pluck('product_id')
            ->toArray();
        $wishlists = Product::whereIn('id', $wishListData)->get();

        return view('pages.account-overview', compact('wishlists'));

    }

    public function aboutPage()
    {
        return view('pages.about');

    }

    public function admin_login()
    {
        return view('admin.login.signin');
    }

    public function checkout()
    {
        $userId = Auth::id();

        if (! $userId) {
            return redirect()->route('login')->with('error', 'Please login to proceed to checkout.');
        }

        $getcheckouts = CartItem::with('product')->where('user_id', $userId)->get();

        $subtotal = 0;
        $tax = 0;
        $shipping = 0;
        $discount = 0;
        $total = 0;

        if ($getcheckouts->isNotEmpty()) {
            $subtotal = $getcheckouts->sum(function ($item) {
                return $item->quantity * ($item->product->price ?? 0);
            });

            $tax = 200;
            $shipping = 500;

            if (session()->has('promo_code')) {
                $coupon = Coupon::where('code', session('promo_code'))->first();
                if ($coupon && (! $coupon->expires_at || now()->lessThan($coupon->expires_at))) {
                    $discount = $coupon->type === 'fixed'
                        ? $coupon->value
                        : ($subtotal * $coupon->value) / 100;
                } else {
                    session()->forget('promo_code');
                }
            }

            $total = max(0, $subtotal + $tax + $shipping - $discount);
        }

        session()->put([
            'product_price' => $total,
            'user_id' => $userId,
        ]);

        return view('pages.checkout', compact(
            'getcheckouts',
            'subtotal',
            'tax',
            'shipping',
            'discount',
            'total'
        ));
    }

    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::findOrFail($id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['success' => true, 'quantity' => $cartItem->quantity]);
    }

    public function product_details($id)
    {

        return view('pages.view-product');
    }

    public function store_users(Request $request)
    {


        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'phone' => 'required|numeric',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        if (! $user->save()) {
            return back()->with('error', 'User Registration Failed!');
        }
        Auth::login($user);

        return redirect('/')->with('success', 'Welcome, you are logged in!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login_user(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/');
            $user = Auth::user();
            session()->put('users', $user);
        } else {
            return redirect()->back()->with('error', 'Invalid Email or Password');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function addToCart(Request $request)
    {

        $request->validate([
            'product_id' => 'required|integer',
            'user_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = CartItem::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'quantity' => 1,
        ]);
        if ($cart) {
            return redirect('/cart')->with('add', 'Cart Added SuccessFully');
        }
    }

    public function delete($id)
    {
        $owner = auth()->check() ? auth()->id() : session()->getId();

        $cartItem = CartItem::where('id', $id)->where('user_id', $owner)->first();
        if ($cartItem) {
            $cartItem->delete();
        }

        return back()->with('success', 'Cart Deleted !');
    }

    public function orderConfirm()
    {
        $total = session()->get('product_price');
        $user = Auth::user();
        $user_id = $user->id;
        $orderNumber = 'ORD-'.date('Ymd').'-'.strtoupper(uniqid());
        $cartItems = CartItem::where('user_id', $user_id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        $order = new Order;
        $order->user_id = $user_id;
        $order->order_number = $orderNumber;
        $order->total_amount = $total;
        $order->shipping_address = $user->address;
        $order->status = 'pending';
        $order->save();
        foreach ($cartItems as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,

            ]);
        }

        Mail::to($user->email)->send(new OrderEmail($order));
        CartItem::where('user_id', $user_id)->delete();

        return redirect()->to('/complete-order')->with([
            'order_id' => $order->id,
            'order_number' => $order->order_number,
        ]);
    }

    public function addOffer(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:coupons,code',
            'value' => 'required|numeric|min:1',
            'expires_at' => 'required',
        ]);

        $coupon = Coupon::create([
            'code' => $request->code,
            'value' => $request->value,
            'type' => 'fixed',
            'expires_at' => $request->expires_at,
        ]);

        session()->put('promo_code', $coupon->code);

        return back()->with('coupons', 'Coupon added successfully!');
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'promo_code' => 'required|string',
        ]);

        $coupon = Coupon::where('code', $request->promo_code)->first();

        if (! $coupon) {
            return back()->withErrors(['promo_code' => 'Invalid coupon code']);
        }

        if ($coupon->expires_at && now()->greaterThan($coupon->expires_at)) {
            return back()->withErrors(['promo_code' => 'Coupon expired']);
        }

        session()->put('promo_code', $coupon->code);

        return back()->with('success', 'Coupon applied successfully!');
    }

    public function shop(Request $request)
    {
        $query = trim($request->input('query'));

        $product = Product::with(['variants', 'category'])
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('slug', 'LIKE', "%{$query}%")
                    ->orWhereHas('variants', function ($variantQuery) use ($query) {
                        $variantQuery->where('name', 'LIKE', "%{$query}%")
                            ->orWhere('sku', 'LIKE', "%{$query}%");
                    })
                    ->orWhereHas('category', function ($categoryQuery) use ($query) {
                        $categoryQuery->where('name', 'LIKE', "%{$query}%");
                    });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('pages.view-product', compact('product', 'query'));

    }

    public function BuyNow(Request $request)
    {
        $request->merge([
            'quantity' => 1,
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
        ]);
        $this->addToCart($request);

        return redirect()->route('checkout');
    }

    public function search_category(Request $request)
    {
        $categoryIds = (array) $request->input('search', []);

        if (empty($categoryIds)) {
            return response()->json([
                'status' => false,
                'data' => ['data' => []],
            ]);
        }

        $products = Product::whereIn('category_id', $categoryIds)->get();

        return response()->json([
            'status' => true,
            'data' => ['data' => $products],
        ]);
    }

    public function forgetpassword_email(Request $request)
    {

        $userdata = Auth::check() ? Auth::user() : '';
        $userEmail = $userdata->email;

        $data = [
            'links' => 'http://127.0.0.1:8000/get_forgetpass',
        ];
        Mail::to($userEmail)->send(new Forgetpasswordmail($data));

        return redirect('/account-overview')->with('fsuc', 'Please Check Your Email Inbox');
    }

    public function get_forget()
    {
        return view('reset_password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'new_password' => 'required|min:6|confirmed',
        ]);
        $user = User::where('email', $request->email)->first();
        if (! $user) {
            return redirect()->back()->with('emailerror', 'Invalid Email!');
        }
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('login');
    }

    public function paymentupdate(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:255',
        ]);
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('fsuc', 'Payment status updated successfully!');
    }

    public function searchByCategory(Request $request)
    {
        $query = Product::with(['variants', 'category']);

        if ($request->filled('category_name')) {
            $categories = (array) $request->input('category_name');
            $query->whereIn('category_id', $categories);
        }

        if ($request->filled('price')) {
            $query->where('price', '<=', $request->input('price'));
        }

        if ($request->has('in_stock')) {
            $query->where('stock', '>', 0);
        }

        if ($request->filled('sort')) {
            switch ($request->input('sort')) {
                case 'low_high':
                    $query->orderBy('price', 'asc');
                    break;
                case 'high_low':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        // 🔹 Pagination
        $products = $query->paginate(9)->withQueryString();
        $categorys = \App\Models\Category::all();

        if ($request->ajax()) {
            return response()->view('partials.product-grid', compact('products'));
        }

        return view('pages.view-product', compact('products', 'categorys'));
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->address = $request->address;
        $user->save();

        return response()->json(['success' => true]);
    }

    public function getBySubcategory($id)
    {
        $product = Product::with(['variants', 'category'])
            ->where('category_id', $id)
            ->get();

        return response()->json([
            'data' => $product,
        ]);
    }
}
