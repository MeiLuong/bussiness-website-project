<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;

class CheckoutController extends Controller
{
    public function orders() {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('backend.layout.page.products.view_order', compact('orders'));
    }
    public function new() {
        $orders = Order::where('status', 'pending')->orderBy('id', 'desc')->get();
        return view('backend.layout.page.products.view_order', compact('orders'));
    }
    public function invoices() {
        $orders = Order::where('status', 'processing')->orderBy('id', 'desc')->get();
        return view('backend.layout.page.products.view_order', compact('orders'));
    }

    public function shipments() {
        $orders = Order::where('status', 'completed')->orderBy('id', 'desc')->get();
        return view('backend.layout.page.products.view_order', compact('orders'));
    }

    public function cancels() {
        $orders = Order::where('status', 'cancel')->orderBy('id', 'desc')->get();
        return view('backend.layout.page.products.view_order', compact('orders'));
    }

    public function edit($id) {
        $order = Order::find($id);
        return view('backend.layout.page.products.edit_order', compact('order'));
    }

    public function update(Request $request, Order $id) {
        $request->validate([
            'status' => 'required'
        ]);

        $input = $request->all();
        $id->update($input);

        return redirect()->route('orders')->with('success', 'Order status updated successfully.');
    }

    public function printOrder($checkout_code) {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }

    public function print_order_convert($checkout_code) {
        $order = Order::with('orderDetails')->find($checkout_code);
        $orderDetails = OrderDetail::with('product')->where('order_id', $order->id)->get();

        $output = '';

        $output .= '
    <style>
            body {
    margin: 0;
    padding: 0;
    background-color: #FAFAFA;
    font: 12pt "Tohoma";
}
* {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}
.page {
    overflow:hidden;
    min-height:297mm;
    padding: 2.5cm;
    margin-left:auto;
    margin-right:auto;
    background: white;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
.subpage {
    padding: 1cm;
    border: 5px red solid;
    height: 237mm;
    outline: 2cm #FFEAEA solid;
}
 @page {
 size: A4;
 margin: 0;
}
button {
    width:100px;
    height: 24px;
}
.header {
}
.logo {
    background-color:#FFFFFF;
    text-align:left;
    float:left;
}
.company {
    padding-top:24px;
    text-transform:uppercase;
    background-color:#FFFFFF;
    text-align:right;
    float:right;
    font-size:16px;
}
.title {
    text-align:center;
    position:relative;
    color:#0000FF;
    font-size: 24px;
    top:1px;
}
.footer-left {
    padding-top:24px;
    position:relative;
    height: 150px;
    width:50%;
    color:#000;
    float:left;
    font-size: 12px;
    bottom:1px;
}
.footer-right {
    padding-top:24px;
    position:relative;
    height: 150px;
    width:50%;
    color:#000;
    font-size: 12px;
    float:right;
    bottom:1px;
}
.TableData {
    background:#ffffff;
    width:100%;
    border-collapse:collapse;
    font-family:Verdana, Arial, Helvetica, sans-serif;
    font-size:12px;
    border:thin solid #d3d3d3;
}
.TableData TH {
    background: rgba(0,0,255,0.1);
    text-align: center;
    font-weight: bold;
    color: #000;
    border: solid 1px #ccc;
    height: 24px;
}
.TableData TR {
    height: 24px;
    border:thin solid #d3d3d3;
}
.TableData TR TD {
    padding-right: 2px;
    padding-left: 2px;
    border:thin solid #d3d3d3;
}
.TableData TR:hover {
    background: rgba(0,0,0,0.05);
}
.TableData .cotSTT {
    text-align:center;
    width: 10%;
}
.TableData .cotTenSanPham {
    text-align:left;
    width: 40%;
}
.TableData .cotHangSanXuat {
    text-align:left;
    width: 20%;
}
.TableData .cotGia {
    text-align:right;
    width: 120px;
}
.TableData .cotSoLuong {
    text-align: center;
    width: 50px;
}
.TableData .cotSo {
    text-align: right;
    width: 120px;
}
.TableData .tong {
    text-align: right;
    font-weight:bold;
    text-transform:uppercase;
    padding-right: 4px;
}
.TableData .cotSoLuong input {
    text-align: center;
}
@media print {
 @page {
 margin: 0;
 border: initial;
 border-radius: initial;
 width: initial;
 min-height: initial;
 box-shadow: initial;
 background: initial;
 page-break-after: always;
}
}
    </style>
<body>
<div id="page" class="page">
    <div class="header">
        <div class="logo">FOCUSPOINT</div>
        <div class="company"></div>
    </div>
  <br/>
  <div class="title">
        ORDER '. '#' . $order->id .'
        <br/>

  </div>
  <div class="customer-infor">
  <h4>Customer Information</h4>
        Name: '. $order->first_name . ' ' . $order->last_name . '<br/>
        Email: '. $order->email .' <br/>
        Phone: '. $order->phone .' <br/>
        Created at: '. $order->created_at .' <br/>
        Order status: '. $order->status .' <br/>
  </div>
  <br/>
  <br/>
  <table class="TableData">
    <tr>
      <th>No</th>
      <th>Product name</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Total</th>
    </tr>';
        $esTotal = 0;
        $i = 0;
        foreach ($orderDetails as $product) {
            $i++;
            $esTotal += $product->total;

            $output .= '
    <tr>
        <td>' . $i . '</td>
        <td>' . $product->product->product_name . '</td>
        <td>'. 'RM' .'' . $product->amount . '</td>
        <td>' . $product->qty . '</td>
        <td>'. 'RM' .'' . $product->total . '</td>
    </tr>';
        }
        $output .='

    <tr>
      <td colspan="4" class="tong">Estimasted Total</td>
      <td class="cotSo">'. 'RM' .' '. $esTotal .'</td>
    </tr>
  </table>
  <div class="footer-left">
  <h3>From</h3><br/>
    FocusPoint Store <br/>
    Email: focuspoint-save@.com <br/>
    Phone: +09877654433 <br/>
    </div>
  <div class="footer-right">
  <h3>To</h3><br/>
    Name: '. $order->first_name . ' ' . $order->last_name .' <br/>
    Phone: '. $order->phone .' <br/>
    Address: '. $order->company_name .' '. ', ' .''. $order->street_address .' '. ', ' .''. $order->town_city .' '. ', ' .''. $order->country .' <br/>';
        if ($order->payment_type == 'direct') {
            $output .= ' Fee: RM'. $esTotal .' ';

        }
        else {
            $output .= 'Fee: Paid';
        }
     $output.= '</div>
</div>
</body>

        ';

        return $output;
    }
}
