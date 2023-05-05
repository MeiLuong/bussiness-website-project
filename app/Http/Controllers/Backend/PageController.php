<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class PageController extends Controller
{
    public function view($id) {
        $page = Page::find($id);

        if(Auth::check())
        {
            $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();
            $count = Cart::with('product')->where('user_id', Auth::user()->id)->count();
            return view('frontend.layout.page.cms.view', compact('page', 'carts', 'count'));

        }

        return view('frontend.layout.page.cms.view', compact('page'));
    }

    public function index() {

        $pages = Page::all();
        $count = Page::all()->count();
        return view('backend.layout.page.stores.pages.pages', compact('pages', 'count'));
    }

    public function add() {
        return view('backend.layout.page.stores.pages.create');
    }

    public function save(Request $request) {
        $request->validate([
            'title' => 'required',
            'url' => 'required|unique:pages'
        ]);

        $newPage = $request->all();
        $check = $this->create($newPage);

        return redirect()->route('index')->with('success', 'Page created successfully.');
    }

    public function create(array $data) {
        return Page::create([
            'title' => $data['title'],
            'url' => $data['url'],
            'status' => $data['status'],
            'content' => $data['content']
        ]);
    }

    public function edit($id) {
        $page = Page::find($id);
        return view('backend.layout.page.stores.pages.edit')->with('page', $page);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required',
            'url' => 'required'
        ]);

        $page = Page::find($id);

        $input = $request->all();
        $page->update($input);

        return redirect()->route('index')->with('success', 'Page updated successfully.');
    }

    public function delete(Page $id) {
        $id->delete();
        return redirect()->route('index')->with('success', 'Page deleted successfully.');
    }
}
