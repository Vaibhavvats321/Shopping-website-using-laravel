<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Cart;
use App\Models\Product;
use Session;
use Stripe;
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $data)
    {
        $fullname = $data->input('fullname');
        $phone = $data->input('phone');
        $address = $data->input('address');
        $bill = $data->input('bill');
        return view('stripe',compact('fullname','phone','address','bill'));
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('SECRET_KEY'));
    
        Stripe\Charge::create ([
                "amount" => $request->input('bill')*100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "New Order's Payment Recieved Successfully" 
        ]);
      
        Session::flash('success', 'Payment successful!');
           
        if(session()->has('id')){
            $order = new Order;
            $order->status = "Paid";
            $order->customerId = session()->get('id');
            $order->bill = $request->input('bill');
            $order->address = $request->input('address');
            $order->fullname = $request->input('fullname');
            $order->phone = $request->input('phone');
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
            return redirect('/cart')->with('success','Success! Your Order has been Placed Successfully.');
        }

        return back();
    }
}
