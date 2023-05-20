<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Cart;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class   HomeController extends Controller
{

//    call data from db

    public function index() {

        $banners = Banner::where('status', 1)->get();

//        call product by category id

        $productFeatures = Product::where('product_feature', true)->get();
        $hotDeals = Product::where('category_id', 14)->get();

//        dd($productFeature); --> to check data


//        call blogs
        $blogs = Blog::orderBy('id', 'desc')->limit(3)->get();



        if(!Auth::check())
        {
            return view('frontend.index', compact('productFeatures', 'hotDeals', 'blogs', 'banners'));
        }
        else {
            $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();
            $count = Cart::with('product')->where('user_id', Auth::user()->id)->count();
            return view('frontend.index', compact('productFeatures', 'hotDeals', 'blogs', 'carts', 'count', 'banners'));

        }


    }

}
