@extends('frontend.layout.master')

@section('title', 'My Orders')

@section('breadcrumbs')
    <div class="breadcrumbs-content">
        <span class="icon fcp-home"></span>
        <span>Home</span> / My Orders
    </div>
@endsection

@section('body')
    <div class="container">
        <div class="page-title text-center">
            <h3 class="title">My Orders</h3>
        </div>
        <div class="row">
            <div class="col-3">
                @include('frontend.layout.block.sidebar.account_sidebar')
            </div>
            <div class="col-9">
                @if($coutOrder <= 0)
                    <div class="" style="margin-bottom: 20px">
                        You don't have any order.
                    </div>
                    <a href="/home" class="btn btn-primary">
                      Shopping now
                    </a>
                @else
                    <table width="100%">
                        <thead>

                        <tr>
                            <th>Order ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Order at</th>
                            <th>Status</th>
                            <th></th>
                        </tr>

                        </thead>

                        <tbody>

                        @foreach($orders as $order)
                            <tr style="height: 50px;">
                                <td>
                                    #{{$order->id}}
                                </td>
                                <td>
                                    {{$order->first_name}} {{$order->last_name}}
                                </td>
                                <td>
                                    {{$order->phone}}
                                </td>
                                <td>
                                    {{$order->created_at}}
                                </td>
                                <td>
                                    @if($order->status == 'pending')
                                        <span class="badge rounded-pill bg-warning">Pending</span>
                                    @elseif($order->status == 'processing')
                                        <span class="badge rounded-pill bg-info">Processing</span>
                                    @elseif($order->status == 'completed')
                                        <span class="badge rounded-pill bg-success">Completed</span>
                                    @elseif($order->status == 'cancel')
                                        <span class="badge rounded-pill bg-danger">Cancel</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('orderDetail', $order->id) }}" class="link-theme">View Order</a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                @endif

            </div>

        </div>
    </div>
@endsection
