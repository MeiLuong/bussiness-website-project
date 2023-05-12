<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class CheckoutController extends Controller
{
    public function index () {

        $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();
        $count = Cart::with('product')->where('user_id', Auth::user()->id)->count();

       return view('frontend.layout.products.checkout.index', compact('carts', 'count'));
    }

    public function addOrder(Request $request) {
        $order = Order::create($request->all());

        $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();

        foreach ($carts as $cart) {
            $data = [
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'qty' => $cart->quantity,
                'amount' => $cart->price,
                'total' => $cart->quantity * $cart->price
            ];

            OrderDetail::create($data);
            Cart::where('product_id', $cart->product_id)->delete();
        }

        $orderId = $order->id;

        return view('frontend.layout.products.checkout.success', compact('orderId'));
    }

    public function myOrder() {
        $orders = Order::with('orderDetails')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $coutOrder = Order::with('orderDetails')->where('user_id', Auth::user()->id)->count();

        $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();
        $count = Cart::with('product')->where('user_id', Auth::user()->id)->count();

        return view('frontend.layout.page.account.order', compact('carts', 'count', 'orders', 'coutOrder'));
    }

    public function orderDetail($id) {
        $orderDetail = Order::findOrFail($id);
//        $productOrders = OrderDetail::with('product')->where('product_id', $orderDetail->orderDetails->product_id)->get();

        $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();
        $count = Cart::with('product')->where('user_id', Auth::user()->id)->count();

        return view('frontend.layout.page.account.orderDetail', compact('carts', 'count', 'orderDetail'));
    }
}
