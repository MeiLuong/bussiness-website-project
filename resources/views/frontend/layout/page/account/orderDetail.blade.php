@extends('frontend.layout.master')

@section('title')
    Order #{{ $orderDetail->id }}
@endsection

@section('breadcrumbs')
    <div class="breadcrumbs-content">
        <span class="icon fcp-home"></span>
        <span>Home</span> / My Orders / Order #{{ $orderDetail->id }}
    </div>
@endsection

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-end">
                    <a href="{{ route('myOrder') }}" class="btn btn-secondary">
                        Back
                    </a>
                </div>
                <!-- Title -->
                <div class="d-flex justify-content-between align-items-center py-3">
                    <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Order #{{ $orderDetail->id }}</h2>
                </div>

                <!-- Main content -->
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Details -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="mb-3 d-flex justify-content-between">
                                    <div>
                                        <span class="me-3">{{ $orderDetail->created_at }}</span>
                                        <span class="me-3">#{{ $orderDetail->id }}</span>
                                        <span class="me-3">
                                            @if($orderDetail->payment_type == 'direct')
                                                Direct Bank Transfer
                                            @elseif($orderDetail->payment_type == 'cash')
                                                Cash on Delivery
                                            @elseif($orderDetail->payment_type == 'paypal')
                                                Paypal
                                            @endif
                                        </span>
                                            @if($orderDetail->status == 'pending')
                                                <span class="badge rounded-pill bg-warning">Pending</span>
                                            @elseif($orderDetail->status == 'processing')
                                                <span class="badge rounded-pill bg-info">Processing</span>
                                            @elseif($orderDetail->status == 'completed')
                                                <span class="badge rounded-pill bg-success">Completed</span>
                                            @elseif($orderDetail->status == 'cancel')
                                                <span class="badge rounded-pill bg-danger">Cancel</span>
                                            @endif

                                    </div>
                                </div>
                                <table class="table table-borderless">
                                    <tbody>
                                    @php
                                        $subtotal = 0
                                    @endphp

                                    @foreach($orderDetail->orderDetails as $productOrder)
                                        @php
                                            $subtotal += $productOrder->total;
                                        @endphp

                                        <tr>
                                            <td>
                                                <div class="d-flex mb-2">
                                                    <div class="flex-shrink-0">
                                                        @if($productOrder->product->product_image == null)
                                                            <img src="assets/images/products/product-default-list-350.jpeg" width="100px"/>
                                                        @else
                                                            <img src="public/assets/images/products/{{ $productOrder->product->product_image }}" alt="" width="50px" class="img-fluid"/>
                                                        @endif

                                                    </div>
                                                    <div class="flex-lg-grow-1 ms-3">
                                                        <h6 class="small mb-0"><a href="/home/product/{{ $productOrder->product_id }}" class="text-reset">
                                                                {{ $productOrder->product->product_name }}
                                                            </a></h6>

                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $productOrder->qty }}
                                            </td>
                                            <td>
                                                RM{{ $productOrder->amount }}
                                            </td>
                                            <td class="text-end">RM{{ $productOrder->total }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="3">Subtotal</td>
                                        <td class="text-end">RM{{ $subtotal }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Shipping</td>
                                        <td class="text-end">RM0</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Discount (Code: none)</td>
                                        <td class="text-danger text-end">-RM0</td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td colspan="3">TOTAL</td>
                                        <td class="text-end">RM{{ $subtotal }}</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- Payment -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3 class="h6">Payment Method</h3>
                                        <p>
                                            @if($orderDetail->payment_type == 'direct')
                                                Direct Bank Transfer
                                            @elseif($orderDetail->payment_type == 'cash')
                                                Cash on Delivery
                                            @elseif($orderDetail->payment_type == 'paypal')
                                                Paypal
                                            @endif
                                            <br>
                                            Total: RM{{ $subtotal }} <span class="badge bg-success rounded-pill">PAID</span></p>
                                    </div>
                                    <div class="col-lg-6">
                                        <h3 class="h6">Billing address</h3>
                                        <address>
                                            <strong>
                                                {{ $orderDetail->first_name }} {{ $orderDetail->last_name }}
                                            </strong><br>
                                            {{ $orderDetail->company_name }}<br>

                                            {{ $orderDetail->street_address }},
                                                {{ $orderDetail->town_city }},
                                            {{ $orderDetail->country }}
                                            <br>
                                            <abbr title="Phone">P:</abbr> {{ $orderDetail->phone }}
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">

                        <div class="card mb-4">
                            <!-- Shipping information -->
                            <div class="card-body">
                                <h3 class="h6">Shipping Information</h3>
                                <hr>
                                <h3 class="h6">Address</h3>
                                <address>
                                    <strong>
                                        {{ $orderDetail->first_name }} {{ $orderDetail->last_name }}
                                    </strong><br>
                                    {{ $orderDetail->company_name }}<br>

                                    {{ $orderDetail->street_address }},
                                    {{ $orderDetail->town_city }},
                                    {{ $orderDetail->country }}
                                    <br>
                                    <abbr title="Phone">P:</abbr> {{ $orderDetail->phone }}
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
