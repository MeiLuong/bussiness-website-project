<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        $count = Product::all()->count();
//        $orderCompletes = OrderDetail::with('product')->where('status', 'completed')->get();



        return view('backend.layout.page.products.product', compact('products', 'count'));
    }

    public function search(Request $request) {
        $search = $request->search ?? '';
        $products = Product::where('product_name', 'like', '%' . $search . '%')->get();
        $count = Product::where('product_name', 'like', '%' . $search . '%')->count();
        return view('backend.layout.page.products.product', compact('products', 'count'));

    }

    public function add() {
        $categories = Category::all();
        $brands = Brand::all();

        return view('backend.layout.page.products.create', compact('categories', 'brands') );
    }
    public function save(Request $request) {
        $request->validate([
            'product_name' => 'required',
            'product_sku' => 'required',
            'product_qty' => 'required',
            'product_price' => 'required',
            'category_id' => 'required',
            'product_feature' => 'required',
            'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $input = $request->all();

        if ($image = $request->file('product_image')) {
            $destinationPath = 'public/assets/images/products/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['product_image'] = "$profileImage";
        }

        Product::create($input);

        return redirect()->route('products')->with('success', 'Product created successfully.');
    }

    public function edit($id) {
        $product = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();
        return view('backend.layout.page.products.edit', compact('categories', 'brands'))->with('product', $product);
    }

    public function update(Request $request, Product $id) {
        $request->validate([
            'product_name' => 'required',
            'product_sku' => 'required',
            'product_qty' => 'required',
            'product_price' => 'required',
            'category_id' => 'required',
            'product_feature' => 'required',
            'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $input = $request->all();

        if ($image = $request->file('product_image')) {
            $destinationPath = 'public/assets/images/blogs/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['product_image'] = "$profileImage";
        }
        else {
            unset($input['product_image']);
        }

        $id->update($input);

        return redirect()->route('products')->with('success', 'Product updated successfully.');
    }

    public function delete(Product $id) {
        $id->delete();
        return redirect()->route('products')->with('success', 'Product deleted successfully.');
    }
}
