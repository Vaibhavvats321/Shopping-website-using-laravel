<?php

namespace App\Http\Controllers;
use DB;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItems;
use App\Mail\Testing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    //
    public function index(){
        $allProducts = Product::all();
        $newArrivals = Product::where('type','new-rrival')->get();
        $hotSales = Product::where('type','hot-sales')->get();
        // dd($allProducts);
        return view('index',compact('allProducts','newArrivals','hotSales'));
    }
    
    public function cart(){
        $cartItems = DB::table('products')->join('carts','carts.productId','products.id')->select('products.title','products.quantity as prodquantity','products.price','products.picture','carts.*')->where('carts.customerId',session()->get('id'))->get();
        return view('cart',compact('cartItems'));
    }
    public function about(){
        return view('about');
    }
    public function shop(){
        return view('shop');
    }
    public function singleProduct($id){
        $product = Product::find($id);
        // dd($product);
        return view('singleProduct',compact('product'));
    }
    public function profile(){
        if(session()->has('id')){
            $user = User::find(session()->get('id'));
            return view('profile',compact('user'));
        }
        return redirect('login')->with('error','Please Login to Your Account.');
    }
    public function myOrders(){
        if(session()->has('id')){
            $orders = Order::where('customerId',session()->get('id'))->get(); 
            $items = DB::table('products')->join('order_items','order_items.productId','products.id')->select('products.title','products.picture','order_items.*')->get();
            return view('myorder',compact('orders','items'));
        }
        return redirect('login')->with('error','Please Login to Your Account.');
    }
    public function register(){
        return view('register');
    }
    public function login(){
        return view('login');
    }
    public function logout(){
        session()->flush('id');
        session()->flush('type');
        return redirect('login');
    }
    public function loginUser(Request $data){
        $User = User::Where('email',$data->input('email'))->Where('password',$data->input('password'))->first();
        if($User){
            if($User->status=="Blocked"){
                return redirect('login')->with('error','Your account is suspended.');
            }
            session()->put('id',$User->id);
            session()->put('type',$User->type);
            if($User->type=='Customer'){
                // dd($User);
                // dd($data->all());
                return redirect('/');
            }else if($User->type=='Admin'){
                return redirect('/admin');
            }
        }else{
            return redirect('login')->with('error','Your Password/Email is incorrect.');
        }
    }
    public function registerUser(Request $data){
        $newUser = new User();
        $newUser->username = $data->input('fullname');
        $newUser->email = $data->input('email');
        $newUser->password = $data->input('password');
        $newUser->picture = $data->file('file')->getClientOriginalName();
        $data->file('file')->move('uploads/profiles',$newUser->picture);
        $newUser->type="Customer";
        if($newUser->save()){
            return redirect('login')->with('success','Congratulations! Your Account is Ready');
        }
    }
    public function updateUser(Request $data){
        $user = User::find(session()->get('id'));
        $user->username = $data->input('fullname');
        $user->password = $data->input('password');
        if($data->file('file')!=null){
            $user->picture = $data->file('file')->getClientOriginalName();
            $data->file('file')->move('uploads/profiles',$user->picture);
        }
        if($user->save()){
            return redirect()->back()->with('success','Congratulations! Your Account is Updated');
        }
    }
    public function addToCart(Request $data){
        if(session()->has('id')){
            $item = new Cart();
            $item->quantity = $data->input('quantity');
            $item->productId = $data->input('id');
            $item->customerId = session()->get('id');
            $item->save();
            return redirect()->back()->with('success','Congratulations! Item Added into Cart');
        }else{
            return redirect('login')->with('error','Info! Please Login to System');

        }
    }
    public function updateCart(Request $data){
            $item = Cart::find($data->input('id'));
            $item->quantity = $data->input('quantity');
            $item->save();
            return redirect()->back()->with('success','Success! Item Quantity Updated');
    }
    public function deleteCartItem($id){
     $item = Cart::find($id);
     $item -> delete();
     return redirect()->back()->with('success','1 Item Removed from Cart');
    }
    public function checkOut(Request $data){
        if(session()->has('id')){
            $order = new Order;
            $order->status = "Pending";
            $order->customerId = session()->get('id');
            $order->bill = $data->input('bill');
            $order->address = $data->input('address');
            $order->fullname = $data->input('fullname');
            $order->phone = $data->input('phone');
            if($order->save()){
                $carts = Cart::where('customerId',session()->get('id'))->get();
                foreach($carts as $item){
                    $product = Product::find($item->productId);
                    $orderItem = new OrderItems;
                    $orderItem->productId = $item->productId;
                    $orderItem->quantity = $item->quantity;
                    $orderItem->price = $product->price;
                    $orderItem->orderId = $order->id;
                    $orderItem->save();
                    $item->delete();
                }
            }
            return redirect()->back()->with('success','Success! Your Order has been Placed Successfully.');
        }else{
            return redirect('login')->with('error','Info! Something Went Wrong');
        }
    }

    public function testMail(){
        $details = [
            'title'=>"This is a testing Mail",'message'=>"Hello this is a message", 
        ];
        Mail::to('harshvatsharma5@gmail.com')->send(new Testing($details));
        return redirect('/');
    }
}
