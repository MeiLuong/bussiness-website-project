<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        $countUser = User::where('level', 2)->count();
        $countOrder = Order::all()->count();

        $sumOrder = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.status', '=', 'completed')
            ->sum('order_details.total');

        $countProduct = Product::all()->count();
        $countReview = ProductReview::all()->count();
        $countCategory = Category::all()->count();
        $countBrand = Brand::all()->count();
        $countBlog = Blog::all()->count();
        $countPage = Page::all()->count();

        return view('backend.layout.page.index', compact('countUser', 'countOrder', 'sumOrder', 'countProduct', 'countReview', 'countCategory', 'countBrand', 'countBlog', 'countPage'));
    }
}
