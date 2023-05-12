@extends('frontend.layout.master')

@section('title', 'Shopping Cart')

@section('style')
    <link rel="stylesheet" href="frontend/css/products/shopping_cart.css" type="text/css">

@endsection

@section('scripts')
    <script type="text/javascript" src="frontend/js/web/products/shopping_cart.js"></script>

    <script>
        function getValue() {
           var val = document.getElementById('quantity').val();
           alert('ok');
           alert(val);
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function(){

        });
    </script>
@endsection

@section('breadcrumbs')
    <div class="breadcrumbs-content">
        <span class="icon fcp-home"></span>
        <span>Home</span> / Shopping Cart
    </div>
@endsection

@section('body')
    <div class="main-content">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    @if($count <= 0)
                        <div class="text-center">
                            No item in shopping cart.

                        </div>
                    @else
                        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                            <div class="row g-0">
                                    <div id="appendCartItems" class="col-lg-8">
                                        <table id="shopping_cart" class="table shopping-cart">
                                            <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Subtotal</th>
                                                <th></th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @php $total = 0 @endphp

                                                @foreach($carts as $cart)
                                                    @php
                                                        $total += $cart->price * $cart->quantity;
                                                    @endphp
                                                    <tr data-id="{{ $cart->id }}">
                                                        <td data-th="Product" style="width: 100%" class="row justify-content-between align-items-center col-md-5 col-lg-5 col-xl-5">
                                                            <div class="main-image col-md-4 col-lg-4 col-xl-4">
                                                                @if($cart->product->product_image == null)
                                                                    <img src="assets/images/products/product-default-list-350.jpeg" width="100px"/>
                                                                @else
                                                                    <img src="public/assets/images/products/{{ $cart->product->product_image }}" width="100px"/>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-8 col-lg-8 col-xl-8">
                                                                <h6 class="name"><a href="home/product/{{ $cart->product->id }}" class="link-theme">{{ $cart->product->product_name }}</a></h6>
                                                            </div>
                                                        </td>
                                                        <td data-th="Price" class="col-md-2 col-lg-2 col-xl-2">
                                                            @if($cart->product->product_discount == null)
                                                                ${{ $cart->price }}

                                                            @else
                                                                ${{ $cart->product->product_old_price }} RM{{ $cart->price }}
                                                            @endif

                                                        </td>
                                                        <td data-th="Quantity" class="col-md-2 col-lg-2 col-xl-2">

                                                            <input type="text" value="{{ $cart->quantity }}" id="quantity" name="quantity" class="form-control quantity cart-update" onchange="getValue()"/>
{{--                                                            <a class="btn btn-sm plus-value updateCartItem icon fcp-plus" data-cartid="{{ $cart->id }}" data-qty="{{ $cart->quantity }}" data-max="1000"></a>--}}
{{--                                                            <a class="btn btn-sm minus-value updateCartItem icon fcp-minus" data-cartid="{{ $cart->id }}" data-qty="{{ $cart->quantity }}" data-min="1"></a>--}}
                                                        </td>
                                                        <td data-th="Subtotal" class="col-md-2 col-lg-2 col-xl-2">
                                                            ${{ $cart->price * $cart->quantity }}
                                                        </td>
                                                        <td class="actions col-md-1 col-lg-1 col-xl-1 text-end" data-th="">
                                                            <form action="{{ route('remove_from_cart', $cart->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button class="action remove cart-remove btn btn-danger"><i class="icon fcp-bin"></i> </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>

                                            <tfoot>

                                            <tr>
                                                <td colspan="5">
                                                    <div class="pt-5">
                                                        <h6 class="mb-0 d-flex" style="justify-content: space-between;">
                                                            <a href="{{ url('/') }}" class="btn btn-secondary"><i
                                                                    class="fas fa-long-arrow-alt-left me-2"></i>Continue Shopping</a>

                                                            <button type="submit" class="btn btn-secondary">Update Cart</button>
                                                        </h6>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tfoot>

                                        </table>
                                    </div>
                                    <div class="col-lg-4 bg-grey">
                                        <div class="p-5">
                                            <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                            <hr class="my-4">

                                            <div class="d-flex justify-content-between mb-4">
                                                @if($count > 1)
                                                    <h5 class="text-uppercase">items: {{ $count }}</h5>
                                                @else
                                                    <h5 class="text-uppercase">item: {{ $count }}</h5>
                                                @endif

                                            </div>

                                            <hr class="my-4">

                                            <div class="d-flex justify-content-between mb-5">
                                                <h5 class="text-uppercase">Total price</h5>
                                                <h5>${{ $total }}</h5>
                                            </div>

                                            <a href="{{ route('checkout') }}" class="btn btn-full">
                                                <button type="button" class="btn btn-full btn-primary"
                                                        data-mdb-ripple-color="dark">Go to checkout</button>
                                            </a>

                                        </div>
                                    </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


