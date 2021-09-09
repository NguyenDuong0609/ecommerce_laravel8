<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

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
        // dd(Cart::content());
        return view('cart');
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
