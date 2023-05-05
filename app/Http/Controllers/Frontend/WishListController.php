<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;


class WishListController extends Controller
{
    public function toWishlist(Request $request) {

        WishList::create($request->except('_token'));

        session()->flash('success', 'Add to wishlist successfully!');
//        return 'Add to wishlist successfully!';
    }

    public function remove(Request $request) {
        $wishlist = WishList::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->delete();
        session()->flash('success', 'Item removed successfully!');
    }

    public function show() {

        $wishlist = WishList::with('product')->where('user_id', Auth::user()->id)->get();

//        fpr cart
        if(Auth::check()) {
            $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();
            $count = Cart::with('product')->where('user_id', Auth::user()->id)->count();
            return view('frontend.layout.page.wishlist', compact('wishlist', 'carts', 'count'));
        }
        return view('frontend.layout.page.wishlist', compact('wishlist'));
    }
}
