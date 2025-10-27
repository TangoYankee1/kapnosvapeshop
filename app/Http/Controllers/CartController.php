<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

    public function store(Request $request)
    {
        $product = Product::findOrFail($request->input('product_id'));

        Cart::add(
            $product->id,
            $product->name,
            $request->input('quantity'),
            $product->price,
            ['image' => $product->image]
        );

        return response()->json(['status' => 'success', 'message' => 'Product added to cart!']);
    }

    public function data()
    {
        return response()->json([
            'cartCount' => Cart::count(),
            'cartSubtotal' => Cart::subtotal(),
            'cartItems' => Cart::content(),
        ]);
    }

    public function update(Request $request, $id)
    {
        Cart::update($id, $request->input('quantity'));

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    public function destroy($id)
    {
        Cart::remove($id);

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }
}
