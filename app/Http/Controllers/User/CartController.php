<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\Cart;
use App\Models\User\Product;
use Illuminate\Http\Request;
use function PHPUnit\Framework\callback;

class CartController extends Controller
{

    public function index($id)
    {
        $cart = Cart::where('user_id', $id)->where('order_id', null)->get();
        //dd($cart);
        return view('user.cart', compact('cart'));
    }

    public function store(Request $request, $user_id, $product_id)
    {
        //dd($old_cart = Cart::where('product_id', $product_id)->where('user_id',$user_id)->first());
        if ($old_cart = Cart::where('product_id', $product_id)->where('user_id', $user_id)->where('order_id', null)->first()) {
            $new_quantity = $old_cart->quantity + $request->quantity;
            //dd($new_quantity);
            $old_cart->quantity = $new_quantity;
            $old_cart->save();
        } else {
            $product = Product::find($product_id);
            $cart = Cart::create([
                'name' => $product->en_name,
                'product_id' => $product_id,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'user_id' => $user_id
            ]);
        }
    }

    public function update(Request $request, $user_id, $cart_id)
    {
        //$old_cart = Cart::where('id', $cart_id)->where('order_id', null)->get();
        //dd($old_cart,$request->quantity);
        Cart::where('id', $cart_id)->where('order_id', null)->update([
            'quantity' => $request->quantity,
        ]);
        $cart = Cart::where('user_id', $user_id)->where('order_id', null)->get();

        return redirect()->route('view.cart',['id' =>$user_id]);
    }

}
