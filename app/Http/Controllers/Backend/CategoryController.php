<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    //
    public function category() {
        $categories = Category::all();
        $count = Category::all()->count();

        return view('backend.layout.page.categories.category', compact('categories', 'count'));
    }

    public function add() {
        return view('backend.layout.page.categories.create');
    }

    public function save(Request $request) {
        $request->validate([
            'category_name' => 'required'
        ]);

        $input = $request->all();

        if ($image = $request->file('category_image')) {
            $destinationPath = 'public/assets/images/categories/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['category_image'] = "$profileImage";
        }

        Category::create($input);

        return redirect()->route('category')->with('success', 'Category has been added.');
    }

    public function edit($id) {
        $category = Category::find($id);
        return view('backend.layout.page.categories.edit')->with('category', $category);
    }

    public function update(Request $request, Category $id) {
        $request->validate([
            'category_name' => 'required'
        ]);

        $input = $request->all();

        if ($image = $request->file('category_image')) {
            $destinationPath = 'public/assets/images/categories/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['category_image'] = "$profileImage";
        }
        else {
            unset($input['category_image']);
        }

        $id->update($input);

        return redirect()->route('category')->with('success', 'Category updated successfully.');
    }

    public function delete(Category $id) {
        $id->delete();
        return redirect()->route('category')->with('success', 'Category deleted successfully.');
    }
}
