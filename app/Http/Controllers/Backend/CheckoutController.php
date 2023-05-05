<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function orders() {
        $orders = Order::all();
        return view('backend.layout.page.products.view_order', compact('orders'));
    }
    public function invoices() {
        $orders = Order::where('status', 'processing')->get();
        return view('backend.layout.page.products.view_order', compact('orders'));
    }

    public function shipments() {
        $orders = Order::where('status', 'completed')->get();
        return view('backend.layout.page.products.view_order', compact('orders'));
    }

    public function cancels() {
        $orders = Order::where('status', 'cancel')->get();
        return view('backend.layout.page.products.view_order', compact('orders'));
    }
}