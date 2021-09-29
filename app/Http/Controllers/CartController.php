<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\Coupon;

class CartController extends Controller
{
    public function storeCart(Request $request)
    {
        Cart::add($request['product_id'], $request['product_name'], $request['product_qty'], $request['product_price'] );

        return [
            'cartContent' => Cart::content(),
            'cartCount' => Cart::count()
        ];
    }

    public function cart()
    {
        return view('cart');
    }

    public function applyCoupon()
    {
        $couponCode = request('coupon_code');
        $couponCode = Coupon::where('code', $couponCode)->first();

        if(!$couponCode) {
            //return redirect()->back()->with('message', 'Sorry! Coupon does not exist');
            return response()->json([
                'status' => 500,
                'errors' => 'Sorry! Coupon does not exist',
            ]);
        }

        Cart::setGlobalDiscount($couponCode->value);

        //return redirect()->back()->with('message', 'coupon applied');
        return response()->json([
            'status' => 200,
            'data' => 'coupon applied',
        ]);
    }

    public function updateCart(Request $request)
    {
        $count = 0;
        foreach(Cart::content() as $row)
        {
            Cart::update($row->rowId, $request['qty'][$count]);
            $count++;
        }

        return view('cart');
    }

    public function deleteCart(Request $request)
    {
        Cart::remove($request['product_id']);

        return true;
    }

    public function checkout()
    {
        return view('checkout');
    }
}
