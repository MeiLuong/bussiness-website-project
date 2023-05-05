@extends('backend.layout.master')

@section('title', 'Admin Account')
@section('body')
    <div class="row">
        @if($count <= 0)
            <div class="text-centert">
                No data to display
            </div>
        @else
            <div class="actions">
                <a href="{{ route('create_adminer') }}" class="action-link">
                    <button class="action add-new">Add New</button>
                </a>
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
                    @foreach($adminers as $adminer)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ $adminer->id }}</td>
                            <td>{{ $adminer->name }}</td>
                            <td>{{ $adminer->email }}</td>
                            <td>{{ $adminer->user_name }}</td>
                            <td>{{ $adminer->phone }}</td>
                            <td>{{ $adminer->address }}</td>
                            <td>{{ $adminer->password }}</td>
                            <td>
                                @if($adminer->level == 1)
                                    Active
                                @else
                                    Un active
                                @endif
                            </td>
                            <td>{{ $adminer->created_at }}</td>
                            <td>{{ $adminer->updated_at }}</td>
                            <td>
                                <a href="{{ route('edit_adminer', $adminer->id) }}"><button class="btn btn-secondary btn-sm">Edit</button></a>
                            </td>
                            <td>
                                <form action="{{ route('delete_adminer', $adminer->id) }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="action delete btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this adminer?')">Delete</button>
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
