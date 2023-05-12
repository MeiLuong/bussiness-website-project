@extends('frontend.layout.layout_micro')

@section('title', 'Thank you for your payment')

@section('style')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
@endsection

@section('body')
    <div class="container">
        <div class="row">
            <div class="jumbotron">
                <h2 class="text-center">YOUR ORDER HAS BEEN RECEIVED</h2>
                <div class="success-icon" style="text-align: center">
                    <span class="icon fcp-checkmark3" style="font-size: 200px; color: limegreen;"></span>
                </div>
                <h3 class="text-center">Thank you for your payment, it’s processing</h3>

                <p class="text-center">Your order is: <a href="{{ route('orderDetail', $orderId) }}" class="link-theme">#{{ $orderId }}</a></p>
                <p class="text-center">You will receive an order confirmation email with details of your order and a link to track your process.</p>
                <center><div class="btn-group" style="margin-top:50px;">
                        <a href="/" class="btn btn-primary btn-lg">CONTINUE SHOPPING</a>
                    </div></center>
            </div>
        </div>
    </div>
@endsection
