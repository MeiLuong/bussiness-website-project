<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductDetailsController extends Controller
{
    //
    public function productDetails($id) {
        $product = Product::findOrFail($id);

        $avgRating = 0;
        $sumRating = array_sum(array_column($product->productReviews->toArray(), 'rating'));
        $countRating = count($product->productReviews);

        if ($countRating != 0) {
            $avgRating = $sumRating / $countRating;
        }

//        get related product listing

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->limit(8)
            ->get();

        //for cart
        if(!Auth::check())
        {
            return view('frontend.layout.products.product_details', compact('product', 'avgRating', 'relatedProducts'));
        }
        else {
            $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();
            $count = Cart::with('product')->where('user_id', Auth::user()->id)->count();

            return view('frontend.layout.products.product_details', compact('product', 'avgRating', 'relatedProducts', 'carts', 'count'));

        }
    }


//    post review of customer

    public function postReview(Request $request) {
        ProductReview::create($request->all());

        return redirect()->back();
    }


    public function index(Request $request) {

//        Get categories, brands
        $categories = Category::all();
        $brands = Brand::all();

//        get products
        $perPage = $request->show ?? 9;
        $sortby = $request->sort_by ?? 'latest';
        $search = $request->search ?? '';

        $products = Product::where('product_name', 'like', '%' . $search . '%');

        $products = $this->filter($products, $request);

        $products = $this->sortAndPagination($products, $sortby, $perPage);

        //for cart
        if(!Auth::check())
        {
            return view('frontend.layout.products.product_listing', compact('categories', 'brands', 'products'));
        }
        else {
            $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();
            $count = Cart::with('product')->where('user_id', Auth::user()->id)->count();
            return view('frontend.layout.products.product_listing', compact('categories', 'brands', 'products', 'carts', 'count'));
        }

    }


    public function category($categoryName, Request $request) {

//        get categories, brands
        $categories = Category::all();
        $brands = Brand::all();

//        get products
        $perPage = $request->show ?? 9;
        $sortby = $request->sort_by ?? 'latest';
        $products = Category::where('category_name', $categoryName)->first()->products->toQuery();
//        dd($counts);


        $products = $this->filter($products, $request);

        $products = $this->sortAndPagination($products, $sortby, $perPage);
//        $countProducts = $this->sortAndPagination($products, $sortby, $perPage)->count();

        //for cart
        if(!Auth::check())
        {
            return view('frontend.layout.products.product_listing', compact('categories', 'brands', 'products'));
        }
        else {
            $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();
            $count = Cart::with('product')->where('user_id', Auth::user()->id)->count();
            return view('frontend.layout.products.product_listing', compact('categories', 'brands', 'products', 'carts', 'count'));

        }

    }




    public function sortAndPagination($products, $sortby, $perPage) {
        switch ($sortby) {
            case 'latest':
                $products = $products->orderBy('id');
                break;

            case 'oldest':
                $products = $products->orderByDesc('id');
                break;

            case 'name-ascending':
                $products = $products->orderBy('product_name');
                break;

            case 'name-descending':
                $products = $products->orderByDesc('product_name');
                break;

            case 'price-ascending':
                $products = $products->orderBy('product_price');
                break;

            case 'price-descending':
                $products = $products->orderByDesc('product_price');
                break;

            default:
                $products = $products->orderBy('id');
        }

        $products = $products->paginate($perPage);

        $products->appends(['sort_by' => $sortby, 'show' => $perPage]);

        return $products;
    }

    public function filter($products, Request $request) {
//        brand
        $brands = $request->brand ?? [];
        $brand_ids = array_keys($brands);
        $products = $brand_ids != null ? $products->whereIn('brand_id', $brand_ids) : $products;

//        price
        $priceMin = $request->price_min;
        $priceMax = $request->price_max;
        $priceMin = str_replace('$', '', $priceMin);
        $priceMax = str_replace('$', '', $priceMax);
        $products = ($priceMin != null && $priceMax != null) ? $products->whereBetween('product_price', [$priceMin, $priceMax]) : $products;

        return $products;
    }

}
