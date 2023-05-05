@extends('backend.layout.master')

@section('title', 'All Pages')

@section('body')
    <div class="row">
        @if($count <= 0)
            <div class="text-centert">
                No data to display
            </div>
        @else
            <div class="actions">
                <a href="{{ route('create_page') }}" class="action-link">
                    <button class="action add-new">Add New</button>
                </a>
            </div>
            <div class="tool-bar">
            </div>
            <div class="table-container">
                <table border="1" width="100%" class="table table-bordered table-striped table-responsive-stack">
                    <thead class="table-dark">
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Url</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ $page->id }}</td>
                            <td>{{ $page->title }}</td>
                            <td>{{ $page->url }}</td>
                            <td>
                                @if($page->status == 1)
                                    Active
                                @else
                                    Un Active
                                @endif
                            </td>
                            <td>{{ $page->created_at }}</td>
                            <td>{{ $page->updated_at }}</td>
                            <td>
                                <a href="{{ route('edit_page', $page->id) }}"><button class="btn btn-secondary btn-sm">Edit</button></a>
                            </td>
                            <td>
                                <form action="{{ route('delete_page', $page->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action delete btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this page?')">Delete</button>
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
