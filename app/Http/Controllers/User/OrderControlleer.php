<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\Cart;
use App\Models\User\Order;
use App\Models\User\ShippingDetails;
use Illuminate\Http\Request;

class OrderControlleer extends Controller
{
    public function index($user_id)
    {
        $cart = Cart::where('user_id',$user_id)->where('order_id',null)->get();
        //dd($cart);
        $total=0;
        foreach ($cart as $carts){
            $total = $total+ ($carts->price*$carts->quantity);
        }
        //dd($total);
        return view('user.checkout',compact('cart','total'));
    }

    public function storeOrder(Request $request,$user_id){

        $total=0;
        $cart = Cart::where('user_id',$user_id)->where('order_id',null)->get();

        foreach ($cart as $carts){
            $total = $total+ ($carts->price*$carts->quantity);
        }
        //dd($request->all() , $user_id ,$total);
        $order = Order::create([
            'user_id' => $user_id,
            'total_price'=>$total,
        ]);

        $cart = Cart::where('user_id',$user_id)->where('order_id',null)->update([
            'order_id'=>$order->id,
        ]);

        $shipping =ShippingDetails:: create([
            'user_id'=>$user_id,
            'full_name'=>$request->full_name,
            'order_id'=>$order->id,
            'country'=>$request->country,
            'address1'=>$request->add1,
            'address2'=>$request->add2,
            'phone_number'=>$request->number,
            'email'=>$request->email,
            'town'=>$request->town,
            'postcode'=>$request->postcode,

        ]);

        //return redirect()->route('user.index');
    }
}
