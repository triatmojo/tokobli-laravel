<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $user_id = Auth::user()->id;
        $carts = Cart::with('product.galleries', 'user')->where('users_id', $user_id)->get();

        return view('pages.cart', [
            'carts' => $carts
        ]);
    }

    public function deleteCart($id)
    {
        $cart = Cart::findOrFail($id);

        $cart->delete($cart);

        return redirect()->route('cart');
    }

    public function success()
    {
        return view('pages.success');
    }
}
