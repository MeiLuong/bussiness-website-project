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
        else {
            return redirect('account/login');
        }
    }

    public function update(Request $request) {

        if ($request->ajax()) {
            $data = $request->all();

//            get cart details
//            $cartDetails = Cart::find($data['cartid']);

//            get available product stock
//            $availableStock = Product::select('product_qty')->where(['id' => $cartDetails['product_id']])->first()->toArray();


            echo "<pre>"; print_r($data); die;

//            if ($data['qty'] > $availableStock['product_qty']) {
//                $getCartItems = Cart::getCartItems();
//                return response()->json([
//                   'status' => false,
//                   'message' => 'Product stock is not available.',
//                   'view' =>  (String)View::make('frontend.layout.page.shopping_cart')->with(compact('getCartItems'))
//                ]);
//            }

            Cart::where('id', $data['cartid'])->update(['quantity' => $data['qty']]);
            $getCartItems = Cart::getCartItems();
            return response()->json([
               'status' => true,
               'view' => (String)View::make('frontend.layout.page.shopping_cart')->with(compact('getCartItems'))
            ]);
        }
    }

    public function remove(Cart $id) {
        $id->delete();
        return redirect()->route('cart')->with('success', 'Cart deleted successfully.');
    }
}
