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
use Carbon\Carbon;
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

//        get new customer
        $newCustomers = User::where('level', 2)->orderBy('id', 'desc')->limit(5)->get();

        //get product best seller
        $bestSellers = DB::table('order_details')
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.status', '<>', 'cancel')
            ->select("product_id", 'products.product_name as product_name', 'products.product_price as product_price', 'products.product_qty as qty_remaining', \DB::raw("SUM(qty) as total"))
            ->groupBy("product_id")
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();


//        statistic of day
        $day = Carbon::now()->day;

        $productQtyDay = OrderDetail::with('product')
            ->select(\DB::raw("SUM(total) as revenue"), \DB::raw("SUM(qty) as productQty"))
            ->whereDay('created_at', $day)
            ->first();

        $countOrderDay = Order::where('status', '<>', 'cancel')->whereDay('created_at', $day)->count();

        $bestSellerDays = DB::table('order_details')
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.status', '<>', 'cancel')
            ->whereDay('orders.created_at', $day)
            ->select("product_id", 'products.product_name as product_name', 'products.product_price as product_price', 'products.product_qty as qty_remain', \DB::raw("SUM(qty) as total"))
            ->groupBy("product_id")
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();



        //        statistic of week
        $productQtyWeek = OrderDetail::with('product')
            ->select(\DB::raw("SUM(total) as revenue"), \DB::raw("SUM(qty) as productQty"))
            ->whereBetWeen('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->first();

        $countOrderWeek = Order::where('status', '<>', 'cancel')->whereBetWeen('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

        $bestSellerWeeks = DB::table('order_details')
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.status', '<>', 'cancel')
            ->whereBetWeen('orders.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->select("product_id", 'products.product_name as product_name', 'products.product_price as product_price', 'products.product_qty as qty_remain', \DB::raw("SUM(qty) as total"))
            ->groupBy("product_id")
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        //        statistic of month
        $month = Carbon::now()->month;

        $productQtyMonth = OrderDetail::with('product')
            ->select(\DB::raw("SUM(total) as revenue"), \DB::raw("SUM(qty) as productQty"))
            ->whereYear('created_at', $month)
            ->first();

        $countOrderMonth = Order::where('status', '<>', 'cancel')->whereYear('created_at', $month)->count();

        $bestSellerMonths = DB::table('order_details')
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.status', '<>', 'cancel')
            ->whereMonth('orders.created_at', $month)
            ->select("product_id", 'products.product_name as product_name', 'products.product_price as product_price', 'products.product_qty as qty_remain', \DB::raw("SUM(qty) as total"))
            ->groupBy("product_id")
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

//        statistic of year
        $year = Carbon::now()->format('Y');

        $productQtyYear = OrderDetail::with('product')
            ->select(\DB::raw("SUM(total) as revenue"), \DB::raw("SUM(qty) as productQty"))
            ->whereYear('created_at', $year)
            ->first();

        $countOrderYear = Order::where('status', '<>', 'cancel')->whereYear('created_at', $year)->count();

        $bestSellerYears = DB::table('order_details')
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.status', '<>', 'cancel')
            ->whereYear('orders.created_at', $year)
            ->select("product_id", 'products.product_name as product_name', 'products.product_price as product_price', 'products.product_qty as qty_remain', \DB::raw("SUM(qty) as total"))
            ->groupBy("product_id")
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();


        return view('backend.layout.page.index', compact('countUser', 'countOrder', 'sumOrder', 'countProduct', 'countReview',
            'countCategory', 'countBrand', 'countBlog', 'countPage', 'newCustomers', 'bestSellers', 'productQtyDay', 'countOrderDay', 'bestSellerDays',
        'productQtyWeek', 'countOrderWeek', 'bestSellerWeeks', 'productQtyYear', 'countOrderYear', 'bestSellerYears', 'productQtyMonth', 'countOrderMonth', 'bestSellerMonths'));
    }
}
