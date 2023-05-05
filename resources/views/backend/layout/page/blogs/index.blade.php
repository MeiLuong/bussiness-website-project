@extends('backend.layout.master')

@section('title', 'Blogs')

@section('body')
    <div class="row">
        @if($count <= 0)
            <div class="text-centert">
                No data to display
            </div>
        @else
            <div class="tool-bar">
                <div class="actions">
                    <a href="{{ route('create_blog') }}" class="action-link">
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
                        <th>Title</th>
                        <th>Image</th>
                        <th>Author</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($blogs as $blog)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ $blog->id }}</td>
                            <td>{{ $blog->title }}</td>
                            <td>
                                @if($blog->image == null)
                                    <img src="assets/images/products/product-default-list-350.jpeg" width="100px" />
                                @else
                                    <img src="public/assets/images/blogs/{{ $blog->image }}" width="100px" />
                                @endif
                            </td>
                            <td>{{ $blog->author }}</td>
                            <td>{{ $blog->created_at }}</td>
                            <td>{{ $blog->updated_at }}</td>
                            <td>
                                <a href="{{ route('edit_blog', $blog->id) }}"><button class="btn btn-secondary btn-sm">Edit</button></a>
                            </td>
                            <td>
                                <form action="{{ route('delete_blog', $blog->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action delete btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this blog?')">Delete</button>
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
