@extends('backend.layout.master')

@section('title', 'Categories')
@section('body')
    <div class="row">
        <div class="actions">
            <a href="{{ route('create_category') }}" class="action-link">
                <button class="action add-new">Add New</button>
            </a>
        </div>
        @if($count <= 0)
            <div class="text-centert">
                No data to display
            </div>
        @else
            <div class="table-container">
                <table border="1" width="100%" class="table table-bordered table-striped table-responsive-stack">
                    <thead class="table-dark">
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>
                                @if($category->category_image == null)
                                    <img src="assets/images/products/product-default-list-350.jpeg" width="100px"/>
                                @else
                                    <img src="public/assets/images/categories/{{ $category->category_image }}" width="100px"/>
                                @endif
                            </td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td>
                                <a href="{{ route('edit_category', $category->id) }}"><button class="btn btn-secondary btn-sm">Edit</button></a>
                            </td>
                            <td>
                                <form action="{{ route('delete_category', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action delete btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this category?')">Delete</button>
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
