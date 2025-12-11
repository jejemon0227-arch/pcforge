<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pest\Matchers\Any;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductCart;
use Session;
use Stripe;
use App\Models\ContactMessage;

class UserController extends Controller
{

    public function home(){
        if(Auth::check()){
            $count= ProductCart::where('user_id',Auth::id())->count();
        }
        else{
            $count='';
        }
        $products = Product::latest()->take(2)->get();
        return view('index',compact('products','count'));

    }
    public function index(){
        if(Auth::check() && Auth::user()->user_type=="user"){ 
            return view('dashboard');
        }
        else if(Auth::check() && Auth::user()->user_type=="admin"){
            return view('admin.dashboard');
         }
    }
    

    public function productDetails($id){
         if(Auth::check()){
            $count= ProductCart::where('user_id',Auth::id())->count();
        }
        else{
            $count='';
        }
        $product = Product::findOrFail($id);
        return view('product_details',compact('product','count'));
    }
    public function allProducts(){
         if(Auth::check()){
            $count= ProductCart::where('user_id',Auth::id())->count();
        }
        else{
            $count='';
        }
        $products =Product::all();
        return view('allproducts',compact('products','count'));
    }











   public function addToCart(Request $request, $product_id)
    {
        // 1. Tiyakin na naka-login bago mag-add to cart
        if (!Auth::check()) {
            return redirect()->route('login')->with('error_message', 'Please login to add items to your cart.');
        }

        // 2. Kuhanin ang Quantity mula sa form at i-validate
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($product_id);
        $quantity = $request->quantity; // Kinuha ang quantity mula sa input field

        $user_id = Auth::id();

        // 3. I-check kung may existing entry na ang product sa cart ng user
        $existing_cart_item = ProductCart::where('user_id', $user_id)
                                          ->where('product_id', $product->id)
                                          ->first();

        if ($existing_cart_item) {
            // A. Kung meron na, i-update ang quantity at price
            $existing_cart_item->quantity += $quantity;
            $existing_cart_item->price = $product->product_price * $existing_cart_item->quantity;
            $existing_cart_item->save();
        } else {
            // B. Kung wala pa, gumawa ng bagong entry
            $product_cart = new ProductCart();
            $product_cart->user_id = $user_id;
            $product_cart->product_id = $product->id;
            $product_cart->quantity = $quantity; // I-store ang quantity
            $product_cart->price = $product->product_price * $quantity; // Calculate total price for this item
            $product_cart->save();
        }
        
        return redirect()->back()->with('cart_message', $quantity . ' item/s of ' . $product->product_title . ' added to the cart.');
    }   
    // app/Http/Controllers/UserController.php

// ... (sa loob ng UserController class) ...

    /**
     * Updates the quantity of a product in the cart.
     */
    public function updateCartQuantity(Request $request, $cart_id)
    {
        // 1. Validation (Tiyakin na valid ang quantity)
        $request->validate([
            'quantity' => 'required|integer|min:1|max:99', // Limitahan ang max based sa stock mo
        ]);

        $new_quantity = $request->quantity;

        // 2. Hanapin ang Cart Item gamit ang $cart_id
        // Tiyakin na ang ProductCart ay imported (use App\Models\ProductCart;)
        $cart_item = ProductCart::findOrFail($cart_id);
        
        // 3. Kuhanin ang Unit Price ng Product
        $unit_price = $cart_item->product->product_price;

        // 4. I-update ang Quantity at Total Price
        $cart_item->quantity = $new_quantity;
        // I-recalculate ang total price para sa item na ito
        $cart_item->price = $unit_price * $new_quantity; 
        $cart_item->save();
        
        // 5. I-redirect pabalik sa cart view
        return redirect()->back()->with('success', 'Cart quantity updated successfully!');
    }

// ... (matapos ang ibang methods) ...






































    public function cartProducts()
    {
       if(Auth::check()){
            $count= ProductCart::where('user_id',Auth::id())->count();
            $cart=ProductCart::where('user_id',Auth::id())->get();
        }
        else{
            $count='';
        }
        return view('viewcartproducts',compact('count','cart'));
    }
    public function removeCartProducts($id){
        $cart_product=ProductCart::findOrFail($id);
        $cart_product->delete();
        return redirect()->back();

    }
    
    public function confirmOrder(Request $request)
{
    $cart_products = ProductCart::where('user_id', Auth::id())->get();
    
    // Tiyakin na ang $address at $phone ay na-declare sa labas ng loop
    $address = $request->receiver_address;
    $phone = $request->receiver_phone;

    foreach ($cart_products as $cart_product) {
        
        // Product Logic (Stock Deduction, Price Calculation, etc.)
        $product = Product::find($cart_product->product_id); // Gamitin ang find()
        
        if (!$product) {
            continue; 
        }

        $cart_qty = (int) $cart_product->quantity;
        $unit_price = (float) $product->product_price;
        
        // --- 1. STOCK DEDUCTION ---
        $product->product_quantity = (int) $product->product_quantity - $cart_qty; 
        $product->save(); 
        
        
        // --- 2. ORDER SAVING FIX (Kumpletuhin ang Required Fields!) ---
        $order = new Order();
        
        // ITO ANG HINDI MO NAISAMA SA ORDER OBJECT:
        $order->receiver_address = $address; // REQUIRED FIELD FIX 1
        $order->receiver_phone = $phone;     // REQUIRED FIELD FIX 2
        $order->user_id = Auth::id();        // REQUIRED FIELD FIX 3
        $order->product_id = $product->id;   // REQUIRED FIELD FIX 4
        
        $order->quantity = $cart_qty; 
        $order->price = $unit_price * $cart_qty; 
        
        $order->save(); // Dito na magwo-work ang save!
    }
    
    ProductCart::where('user_id', Auth::id())->delete();
    
    return redirect()->back()->with('confirm_order', "Order Confirmed. Stock and Prices updated.");
}


    public function myOrders(){
        $orders=Order::where('user_id',Auth::id())->get();
        return view('viewmyorders',compact('orders'));
    }
     public function stripe($price)

    {
        if(Auth::check()){
            $count= ProductCart::where('user_id',Auth::id())->count();
            $cart=ProductCart::where('user_id',Auth::id())->get();
        }
        else{
            $count='';
        }
       

        return view('stripe',compact('count','price'));

    }
    
    public function stripePost(Request $request)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    

        Stripe\Charge::create ([

                "amount" => 100 * 100,

                "currency" => "usd",

                "source" => $request->stripeToken,

                "description" => "Test payment from itsolutionstuff.com." 

        ]);

        $cart_product_id=ProductCart::where('user_id',Auth::id())->get();
        $address=$request->receiver_address;
        $phone=$request->receiver_phone;

        foreach($cart_product_id as $cart_product){
        $order=New Order();
        $order->receiver_address=$address;
        $order->receiver_phone=$phone;
        $order->user_id=Auth::id();

        $order->product_id=$cart_product->product_id;
        $order->payment_status="paid";
        $order->save();

        }
        $cart=ProductCart::where('user_id',Auth::id())->get();
        foreach($cart as $cart){
            $cart_id=ProductCart::findOrFail($cart->id);
            $cart_id->delete();
        }
      

        return redirect()->back()->with('success', 'Payment successful!');

    }

  
  public function contactForm()
{
    return view('contact'); // Make sure this Blade exists
}

// Handle form submission
// app/Http/Controllers/UserController.php

public function submitContact(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255', // <-- IDAGDAG ITO
        'email' => 'required|email',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string',
    ]);

    ContactMessage::create([
        'user_id' => Auth::id(),
        'name' => $validated['name'], // <-- IDAGDAG ITO
        'email' => $validated['email'],
        'subject' => $validated['subject'] ?? null,
        'message' => $validated['message'],
    ]);

    return back()->with('success', 'Your message has been sent successfully!');
    }
    public function whyUs()
    {
        // 1. Tiyakin na tama ang View name mo. 
        // Siguraduhin na meron kang resources/views/why-us.blade.php
        return view('whyus'); 
    }

}

    
