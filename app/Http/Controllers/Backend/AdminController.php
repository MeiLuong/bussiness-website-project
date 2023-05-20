<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() {

        return view('backend.layout.page.account.login');
    }

    public function login(Request $request) {

        $request->validate([
            'user_name' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('user_name', 'password', 'level');

        if(Auth::attempt($credentials)) {
            return redirect()->intended('/admin/dashboard')
                ->with('message', 'Signed in!');
        }

        return redirect('/admin')->with('message', 'Login details are not valid!');
    }

    public function logOut() {
        Session::flush();
        Auth::logout();

        return redirect('/admin');
    }
    public function adminer() {
        $adminers = User::where('level', 0)->orwhere('level', 1)->get();
        $count = User::where('level', 0)->orwhere('level', 1)->count();
//        dd($customers);

        return view('backend.layout.page.adminer', compact('adminers', 'count'));
    }

    public function add() {
        return view('backend.layout.page.users.new_adminer');
    }

    public function save(Request $request) {
        $request->validate([
            'name' => 'required',
            'user_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required_with:password|same:password|min:6'
        ]);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        $newCustomer = $request->all();
        $check = $this->create($newCustomer);

        return redirect('/admin/adminer')->with('success', 'Adminer created successfully !');
    }

    public function create(array $data) {
        return User::create([
            'name' => $data['name'],
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'level' => $data['level']
        ]);
    }

    public function edit($id) {
        $adminer = User::find($id);
        return view('backend.layout.page.users.edit_adminer')->with('adminer', $adminer);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
        ]);
        $adminer = User::find($id);
        $input = $request->all();
        $adminer->update($input);
        return redirect('/admin/adminer')->with('success', 'Adminer updated successfully.');
    }

    public function delete($id) {
        User::destroy($id);
        return redirect('/admin/adminer')->with('success', 'Delete adminer successfully.');
    }

    public function changePassword() {
        return view('backend.layout.page.users.changePassword');
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
            return redirect('/admin/dashboard')->with('success', 'Password test updated successfully.');
        }
        else {
            return redirect()->back()->with('error', 'Current password does not match width old password.');
        }
    }

//    chart
    public function filter_by_date(Request $request) {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Order::whereBetween('createed_at', [$from_date, $to_date])->orderBy('created_at', 'asc')->get();

        foreach ($get as $val){
            $chart_data = array(
                'period' => $val->created_at,
                'order' => $val->total
            );
        }

        echo $data = json_encode($chart_data);
    }
}
