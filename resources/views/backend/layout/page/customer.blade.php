@extends('backend.layout.master')

@section('title', 'Customers')
@section('body')
    <div class="row">
        @if($count <= 0)
            <div class="text-centert">
                No data to display
            </div>
        @else
            <div class="tool-bar">
                <div class="actions">
                    <a href="{{ route('customerCreate') }}" class="action-link">
                        <button class="action add-customer">Add New</button>
                    </a>
                </div>
            </div>
            <div class="table-container">
                <table border="1" width="100%" class="table table-bordered table-striped table-responsive-stack">
                    <thead class="table-dark">
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Password</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->user_name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->password }}</td>
                            <td>
                                @if($customer->level == 2)
                                    Active
                                @else
                                    Un active
                                @endif
                            </td>
                            <td>{{ $customer->created_at }}</td>
                            <td>{{ $customer->updated_at }}</td>
                            <td>
                                <a href="{{ route('edit_customer', $customer->id) }}"><button class="btn btn-secondary btn-sm">Edit</button></a>
                            </td>
                            <td>
                                <form action="{{ route('delete_customer', $customer->id) }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="action delete btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this customer?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection

