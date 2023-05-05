<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Cart;
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
            return view('frontend.layout.page.account.dashboard', compact('carts', 'count'));
        }

        return redirect('/account/login')->with('success', "Register successfully.");
    }

    public function logOut() {
        Session::flush();
        Auth::logout();

        return redirect('/account/login')->with('success', "Log out successfully.");
    }

}
