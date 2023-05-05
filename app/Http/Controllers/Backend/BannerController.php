<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index() {
        $banners = Banner::all();
        $count = Banner::all()->count();

        return view('backend.layout.page.banner.index', compact('count'))->with('banners', $banners);
    }

    public function add() {
        return view('backend.layout.page.banner.create');
    }

    public function save(Request $request) {
        $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'public/assets/images/banner/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        Banner::create($input);

        return redirect()->route('banners')->with('success', 'Banner created successfully.');
    }

    public function edit($id) {
        $banner = Banner::find($id);
        return view('backend.layout.page.banner.edit')->with('banner', $banner);
    }

    public function update(Request $request, Banner $id) {
        $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'public/assets/images/banner/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        else {
            unset($input['image']);
        }

        $id->update($input);

        return redirect()->route('banners')->with('success', 'Banner updated successfully.');
    }

    public function delete(Banner $id) {
        $id->delete();
        return redirect()->route('banners')->with('success', 'Banner deleted successfully.');
    }


}
