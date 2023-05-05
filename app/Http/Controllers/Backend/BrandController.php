<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index () {
        $brands = Brand::all();
        $count = Brand::all()->count();
        return view('backend.layout.page.brands.index', compact('count'))->with('brands', $brands);

    }

    public function add() {
        return view('backend.layout.page.brands.create');
    }

    public function save(Request $request) {
        $request->validate([
            'brand_name' => 'required',
            'brand_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $input = $request->all();

        if ($image = $request->file('brand_image')) {
            $destinationPath = 'public/assets/images/brands/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['brand_image'] = "$profileImage";
        }

        Brand::create($input);

        return redirect()->route('brands')->with('success', 'Brand created successfully.');
    }

    public function edit($id) {
        $brand = Brand::find($id);
        return view('backend.layout.page.brands.edit')->with('brand', $brand);
    }

    public function update(Request $request, Brand $id) {
        $request->validate([
            'brand_name' => 'required',
            'brand_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $input = $request->all();

        if ($image = $request->file('brand_image')) {
            $destinationPath = 'public/assets/images/brands/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['brand_image'] = "$profileImage";
        }
        else {
            unset($input['brand_image']);
        }

        $id->update($input);

        return redirect()->route('brands')->with('success', 'Brand updated successfully.');
    }

    public function delete(Brand $id) {
        $id->delete();
        return redirect()->route('brands')->with('success', 'Brand deleted successfully.');
    }
}
