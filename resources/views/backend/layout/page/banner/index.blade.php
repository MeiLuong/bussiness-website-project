@extends('backend.layout.master')

@section('title', 'All Banner')

@section('body')

    <div class="row">

            <div class="actions">
                <a href="{{ route('create_banner') }}" class="action-link">
                    <button class="action add-new">Add New</button>
                </a>
            </div>

            <div class="table-container">
                @if($count <= 0)
                    <div class="text-centert">
                        No data to display
                    </div>
                @else
                    <table border="1" width="100%" class="table table-bordered table-striped table-responsive-stack">
                        <thead class="table-dark">
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($banners as $banner)
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>{{ $banner->id }}</td>
                                <td>{{ $banner->title }}</td>
                                <td>
                                    @if($banner->image == null)
                                        <img src="assets/images/products/product-default-list-350.jpeg" width="100px"/>
                                    @else
                                        <img src="public/assets/images/banner/{{ $banner->image }}" width="100px"/>
                                    @endif
                                </td>
                                <td>
                                    @if($banner->status == 1)
                                        Active
                                    @else
                                        Un Active
                                    @endif
                                </td>
                                <td>{{ $banner->created_at }}</td>
                                <td>{{ $banner->updated_at }}</td>
                                <td>
                                    <a href="{{ route('edit_banner', $banner->id) }}"><button class="btn btn-secondary btn-sm">Edit</button></a>
                                </td>
                                <td>
                                    <form action="{{ route('delete_banner', $banner->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action delete btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this banner?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
    </div>

@endsection
