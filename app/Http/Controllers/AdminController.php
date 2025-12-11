<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\ContactMessage;

class AdminController extends Controller
{
    public function addCategory()
    {
        return view('admin.addcategory');
    }
    public function postAddCategory(Request $request){
        $category=new Category();
        $category->category = $request->category;
        $category->save();
        return redirect()->back()->with('category_message','Category added successfully');
    }

    public function viewCategory(){
        $categories= Category::all();
        return view('admin.viewcategory' ,compact('categories'));

   }

   public function deleteCategory($id){
    $category=Category::findOrFail($id);
    $category->delete();

    return redirect()->back()->with('deletecategory_message','Deleted successfully');

   }

   public function updateCategory($id){
    $category=Category::findOrFail($id);
    return view('admin.updatecategory', compact('category'));
   }

   public function postUpdatecategory(Request $request, $id){
    $category=Category::findOrFail($id);

    $category->category=$request->category;
    $category->save();
    return redirect()->back()->with('category_updated_message','Category is Updated successfully!');

   }
   public function addProduct(){
    $categories = Category::all();
     return view('admin.addproduct',compact('categories'));
   }
   public function postAddProduct(Request $request){

        $product = new Product();
        $product->product_title=$request->product_title;
        $product->product_description=$request->product_description;
        $product->product_quantity=$request->product_quantity;
        $product->product_price=$request->product_price;

        $image=$request->product_image;

        if($image){
            
            $imagename =time().'.'.$image->getClientOriginalExtension();
            $product->product_image=$imagename;
        }
        $product->product_category=$request->product_category;
        $product->save();
        if($image && $product->save()){
            $request->product_image->move('products', $imagename);
        }

        return redirect()->back()->with('product_message','product added successfully!');
   }
   public function viewProduct(){
    $products = Product::paginate(3);
    return view('admin.viewproduct',compact('products'));
   }
   public function deleteProduct($id){
    $product = Product::findOrFail($id);
    $image_path=public_path('products/'.$product->product_image);
    if(file_exists($image_path)){
        unlink(($image_path));
    }

    $product->delete();
    return redirect()->back()->with('deleteproduct_message','product deleted successfully!');
   }
   public function updateProduct($id){
    $product=Product::findOrFail($id);
    $categories=Category::all();
    return view('admin.updateproduct',compact('product','categories'));
   }

   public function postUpdateProduct(Request $request, $id){
    $product=Product::findOrFail($id);
        $product->product_title=$request->product_title;
        $product->product_description=$request->product_description;
        $product->product_quantity=$request->product_quantity;
        $product->product_price=$request->product_price;
        $image=$request->product_image;
        if($image){
            $imagename =time().'.'.$image->getClientOriginalExtension();
            $product->product_image=$imagename;
        }
        $product->product_category=$request->product_category;
        $product->save();
        if($image && $product->save()){
            $request->product_image->move('products', $imagename);

        }
        return redirect()->back()->with('product_message','product added successfully!');
   }
   public function searchProduct(Request $request){
    $products=Product::where('product_title','LIKE', '%'.$request->search.'%')
           -> orWhere('product_description','LIKE', '%'.$request->search.'%')
          ->  orWhere('product_category','LIKE', '%'.$request->search.'%') ->paginate(2);



    return view('admin.viewproduct',compact('products'));
   }
   public function viewOrders(){
    $orders=Order::all();
    return view('admin.vieworders',compact('orders'));
   }
   public function changeStatus(Request $request, $id){
    $order = Order::findOrFail($id);
    $order->status=$request->status;
    $order->save();
    return redirect()->back();
   }
   public function downloadpdf($id){
    $data=order::findOrFail($id);
    $pdf = Pdf::loadView('admin.invoice', compact('data') );
    return $pdf->download('invoice.pdf');
   }


      public function viewUsers()
            {
    
    $users = User::where('user_type', 'user')->get();

    return view('admin.viewusers', compact('users'));
            }


        public function userDetails($id)
                {
    $user = User::findOrFail($id);
    return view('admin.userdetails', compact('user'));
        }
        
public function showContactMessage($id){
    $message = ContactMessage::findOrFail($id);

   return view('admin.viewmessages', compact('message'));

        }
        public function viewContactMessages(){
    $messages = ContactMessage::latest()->get();

    return view('admin.viewmessageslist', compact('messages'));
  }
  

}
