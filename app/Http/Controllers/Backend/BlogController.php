<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BlogController extends Controller
{
    //
    public function index() {
        $blogs = Blog::all();
        $count = Blog::all()->count();
        return view('backend.layout.page.blogs.index', compact('blogs', 'count'));
    }

    public function add() {
        return view('backend.layout.page.blogs.new_blog');
    }

    public function save(Request $request) {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'public/assets/images/blogs/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        Blog::create($input);

        return redirect()->route('blogs')->with('success', 'Blog created successfully.');
    }

    public function edit($id) {
        $blog = Blog::find($id);
        return view('backend.layout.page.blogs.edit_blog')->with('blog', $blog);
    }

    public function update(Request $request, Blog $id) {
        $request->validate([
            'title' => 'required',
            'author' => 'required'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'public/assets/images/blogs/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        else {
            unset($input['image']);
        }

        $id->update($input);

        return redirect()->route('blogs')->with('success', 'Blog updated successfully.');
    }

    public function delete(Blog $id) {

        $id->delete();
        return redirect()->route('blogs')->with('success', 'Blog deleted successfully.');
    }

}
