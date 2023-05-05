<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function list() {

        $blogs = Blog::orderBy('id', 'desc')->get();

        if(Auth::check()) {
            $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();
            $count = Cart::with('product')->where('user_id', Auth::user()->id)->count();

            return view('frontend.layout.blogs.list', compact('blogs', 'carts', 'count'));
        }
        return view('frontend.layout.blogs.list', compact('blogs'));
    }

    public function details($id) {
        $blog = Blog::find($id);
        $blogs = Blog::orderBy('id', 'desc')->get();

        if(Auth::check()) {
            $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();
            $count = Cart::with('product')->where('user_id', Auth::user()->id)->count();

            return view('frontend.layout.blogs.details', compact('blog', 'blogs', 'carts', 'count'));
        }
        return view('frontend.layout.blogs.details', compact('blog', 'blogs'));
    }
}
