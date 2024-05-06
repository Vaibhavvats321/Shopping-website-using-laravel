<?php

namespace App\Http\Controllers;
use DB;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        if(session()->get('type')=='Admin'){
            return view('dashboard.index');
        }
        return redirect()->back();
    }

    public function products(){
        if(session()->get('type')=='Admin'){
            $products = Product::all();
            return view('Dashboard.products',compact('products'));
        }
        return redirect()->back();
    }

    public function ourCustomers(){
        if(session()->get('type')=='Admin'){
            $ourCustomers = User::where('type','customer')->get();
            return view('Dashboard.customers',compact('ourCustomers'));
        }
        return redirect()->back();
    }

    public function ourOrders(){
        if(session()->get('type')=='Admin'){
            $orderItem=DB::table('order_items')
            ->join('products','order_items.productId','products.id')
            ->select('products.title','products.picture','order_items.*')
            ->get();
            $ourOrders=DB::table('users')
            ->join('orders','orders.customerId','users.id')
            ->select('orders.*','users.username','users.email','users.status as userStatus')
            ->get();
            return view('Dashboard.orders',compact('ourOrders','orderItem'));
        }
        return redirect()->back();
    }

    public function AddNewProduct(Request $data){
        if(session()->get('type')=='Admin'){
            $product = new Product();
            $product->title = $data->input('title');
            $product->price = $data->input('price');
            $product->quantity = $data->input('quantity');
            $product->type = $data->input('type');
            $product->category = $data->input('category');
            $product->description = $data->input('description');
            $product->picture = $data->file('file')->getClientOriginalName();
            $data->file('file')->move('uploads/products/',$product->picture);
            $product->save();
            return redirect()->back()->with('success','congrats! Your product added successfully');
        }
        return redirect()->back();
    }

    public function UpdateProduct(Request $data){
        if(session()->get('type')=='Admin'){

            $product = Product::find($data->input('id'));
            $product->title = $data->input('title');
            $product->price = $data->input('price');
            $product->quantity = $data->input('quantity');
            $product->type = $data->input('type');
            $product->category = $data->input('category');
            $product->description = $data->input('description');
            if($data->file('file')!= null){
                $product->picture = $data->file('file')->getClientOriginalName();
                $data->file('file')->move('uploads/products/',$product->picture);
            }
            $product->save();
            return redirect()->back()->with('success','congrats! Product updated successfully');
        }
        return redirect()->back();
    }

    public function DeleteProduct($id){
        if(session()->get('type')=='Admin'){
            $product = Product::find($id);
            $product->delete();
            return redirect()->back()->with('success','congrats! Product deleted successfully');
        }
        return redirect()->back();
    }

    public function changeUserStatus($status,$id){
        if(session()->get('type')=='Admin'){
            $user = User::find($id);
            $user->status=$status;
            $user->save();
            return redirect()->back()->with('success','congrats! User status changed successfully');
        }
        return redirect()->back();
    }

    public function changeOrderStatus($status,$id){
        if(session()->get('type')=='Admin'){
            $Order = Order::find($id);
            $Order->status=$status;
            $Order->save();
            return redirect()->back()->with('success','congrats! Order status changed successfully');
        }
        return redirect()->back();
    }

    public function adminProfile(){
        if(session()->get('type')=='Admin'){
            $user = User::find(session()->get('id'));
            return view('dashboard.profile',compact('user'));
        }
        return redirect()->back();
    }
    
}
