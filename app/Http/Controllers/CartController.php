<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $items = Auth::user()->cart()->with('product')->get();
        } else {
            $items = collect(Session::get('cart', []));
        }

        return view('cart', ['items' => $items]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        $productId = $request->product_id;
        $quantity = $request->quantity;

        if (Product::find($productId)->stock < $quantity) {
            return response()->json(['success' => false, 'message' => 'Product out of stock.']);
        }

        if (Auth::check()) {
            Cart::updateOrCreate([
                'product_id' => $productId,
                'user_id' => Auth::id(),
                'quantity' => $quantity,
            ]);
        } else {
            $cart = Session::get('cart', []);
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] = $quantity;
            } else {
                $cart[$productId] = [
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'product' => Product::find($productId),
                ];
            }
            $cart = collect($cart);
            Session::put('cart', $cart);
        }
        return response()->json(['success' => true, 'message' => 'Product added to cart.']);
    }

    public function remove(Request $request)
    {
        if (Auth::check()) {
            Cart::where('product_id', $request->product_id)->where('user_id', Auth::id())->delete();
        } else {
            $cart = collect(Session::get('cart', []));
            $cart->forget($request->product_id);

            Session::put('cart', $cart);
        }

        return response()->json(['success' => true, 'message' => 'Product removed from cart.']);
    }

    public function empty()
    {
        if (Auth::check()) {
            $items = Auth::user()->cart()->with('product')->get();

            foreach ($items as $item) {
                $item->delete();
            }
        } else {
            Session::forget('cart');
        }

        return response()->json(['success' => true, 'message' => 'Cart is empty.']);
    }
}
