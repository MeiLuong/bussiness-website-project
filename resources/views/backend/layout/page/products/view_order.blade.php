@extends('backend.layout.master')

@section('title', 'Orders')

@section('body')
    <div class="row">
        <div class="tool-bar">
            <div class="actions">
                <a href="{{ route('create_product') }}" class="action-link">
                    <button class="action add-new">Add New</button>
                </a>
            </div>
        </div>
        <div class="table-container">
            <table border="1" width="100%" class="table table-bordered table-striped table-responsive-stack">
                <thead class="table-dark">
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Customer First Name</th>
                    <th>Customer Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->first_name }}</td>
                        <td>{{ $order->last_name }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>
                            @if($order->status == 'pending')
                                Pending
                            @elseif($order->status == 'processing')
                                Processing
                            @elseif($order->status == 'completed')
                                Completed
                            @elseif($order->status == 'cancel')
                                Cancel
                            @endif
                        </td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->updated_at }}</td>
                        <td>
                            <a href="{{ route('edit_product', $order->id) }}"><button class="btn btn-secondary btn-sm">Edit</button></a>
                        </td>
                        <td>
                            <form action="{{ route('delete_product', $order->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action delete btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this order?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
