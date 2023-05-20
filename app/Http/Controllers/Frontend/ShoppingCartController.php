<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Session;

class ShoppingCartController extends Controller
{

    public function cart() {
        $getCartItems = Cart::getCartItems();
//        dd($getCartItems);
        $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();
        $count = Cart::with('product')->where('user_id', Auth::user()->id)->count();

        return view('frontend.layout.page.shopping_cart', compact('carts', 'count'));
    }

    public function addToCart(Request $request, $id) {
        if (Auth::id()) {
            if ($request->product_qty > $request->product_stock) {
                return redirect()->back()->with('error', 'Product quantity not enough.');
            }
            else if($request->product_qty < 1) {
                return redirect()->back()->with('error', 'Product quantity must be bigger than 1.');
            }
            else {
                $user = auth()->user();
                $product = Product::find($id);

                $cart = new Cart;
                $cart->user_id = $user->id;
                $cart->name = $user->name;
                $cart->product_id = $product->id;
                $cart->quantity = $request->product_qty;
                $cart->price = $product->product_price;
                $cart->save();

                return redirect()->back()->with('success', 'Product have been added in cart.');
            }

        }
        else {
            return redirect('account/login');
        }
    }

    public function update(Request $request) {
//        dd($request);
        $request->validate([
            'quantity' => 'required'
        ]);

        $cartId = $request->id;
        $qty = $request->quantity;
        $stock = $request->product_stock;

        if ($qty > $stock) {
            return redirect()->route('cart')->with('error', 'Product quantity not enough.');
        }
        else if($qty < 1) {
            return redirect()->route('cart')->with('error', 'Product quantity must be bigger than 1.');
        }
        else {
            $input = $request->all();

            $cart = Cart::find($cartId);

            $cart->quantity = $qty;

            $cart->save();

            return redirect()->route('cart')->with('success', 'Cart updated successfully.');
        }

    }

//    public function remove(Cart $id) {
//        $id->delete();
//        return redirect()->route('cart')->with('success', 'Cart deleted successfully.');
//    }

//    public function update(Request $request) {
//        $cart = Cart::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->update();
//        session()->flash('success', 'Cart updated successfully.');
//    }

    public function remove(Request $request) {
        $cart = Cart::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->delete();
        session()->flash('success', 'Cart deleted successfully.');
    }
}
