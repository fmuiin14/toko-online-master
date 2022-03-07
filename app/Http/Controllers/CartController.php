<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // $carts = Cart::with(['user', 'product'])->where('users_id', Auth::user()->id)->get();

        $carts = DB::table('carts')
            ->join('users', 'users_id', '=', 'users.id')
            ->join('products', 'products_id', 'products.id')
            ->get();

        // dd($carts);
        
        return view('fe.pages.cart',[
            'carts' => $carts
        ]);
    }

    public function delete(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        $cart->delete();

        return redirect()->route('cart');
    }
}
