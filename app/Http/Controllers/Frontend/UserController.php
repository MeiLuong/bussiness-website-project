<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index() {

        return view('frontend.layout.page.account.login');
    }

    public function login(Request $request) {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password', 'level');

        if(Auth::attempt($credentials)) {
            return redirect()->intended('/account/dashboard')
                ->with('success', 'Signed in!');
        }

        return redirect('/account/login')->with('error', 'Login details are not valid!');
    }

    public function register() {
        return view('frontend.layout.page.account.register');
    }

    public function registerSave(Request $request) {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $register = $request->all();
        $check = $this->create($register);

        return redirect('/account/dashboard');
    }

    public function create(array $data) {

        return User::create([
            'name' => $data['name'],
            'user_name' => '',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'address' => $data['address'],
            'level' => 2
        ]);

    }

    public function account() {
        if(Auth::check()) {
            $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();
            $count = Cart::with('product')->where('user_id', Auth::user()->id)->count();
            $user = User::where('id', Auth::user()->id);
            return view('frontend.layout.page.account.dashboard', compact('carts', 'count', 'user'));
        }

        return redirect('/account/login')->with('success', "Register successfully.");
//        $segment = $request->segment(1);
//
//        dd($segment);
    }

    public function logOut() {
        Session::flush();
        Auth::logout();

        return redirect('/account/login')->with('success', "Log out successfully.");
    }

    public function edit($id) {
        $user = User::find($id);
        $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();
        $count = Cart::with('product')->where('user_id', Auth::user()->id)->count();

        return view('frontend.layout.page.account.edit', compact('carts', 'count'))->with('user', $user);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'user_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $customer = User::find($id);
        $input = $request->all();
        $customer->update($input);
        return redirect('/account/dashboard')->with('success', 'Account information updated successfully.');
    }

    public function changePassword() {
        $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();
        $count = Cart::with('product')->where('user_id', Auth::user()->id)->count();

        return view('frontend.layout.page.account.change_password', compact('carts', 'count'));
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'current_password' => 'required|min:6',
            'password' => 'required|min:6',
            'confirm_password' => 'required_with:password|same:password|min:6'
        ]);

        $currentPassword = Hash::check($request->current_password, auth()->user()->password);

        if($currentPassword) {
            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect('/account/dashboard')->with('success', 'Password updated successfully.');
        }
        else {
            return redirect()->back()->with('error', 'Current password does not match width old password.');
        }
    }

}
