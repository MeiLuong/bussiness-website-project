<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{

    public function customers() {
        $customers = User::where('level', 2)->orwhere('level', 3)->get();
        $count = User::where('level', 2)->orwhere('level', 3)->count();
//        dd($customers);

        return view('backend.layout.page.customer', compact('customers', 'count'));
    }

    public function addCustomer() {
        return view('backend.layout.page.users.new_customer');
    }

    public function customerSave(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required_with:password|same:password|min:6',
        ]);

        $newCustomer = $request->all();
        $check = $this->create($newCustomer);

        return redirect('/admin/customers')->with('success', 'Customer created successfully !');
    }

    public function create(array $data) {

        return User::create([
            'name' => $data['name'],
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'address' => $data['address'],
            'level' => $data['level']
        ]);

    }

    public function edit($id) {
        $customer = User::find($id);
        return view('backend.layout.page.users.edit_customer')->with('customer', $customer);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required'
        ]);
        $customer = User::find($id);
        $input = $request->all();
        $customer->update($input);
        return redirect('/admin/customers')->with('success', 'Customer updated successfully.');
    }

    public function delete($id) {

        User::destroy($id);
        return redirect('/admin/customers')->with('success', 'Delete customer successfully.');

    }

}
