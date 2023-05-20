@extends('backend.layout.master')

@section('title', 'All Brands')

@section('body')
    <div class="row">
        @if($count <= 0)
            <div class="text-centert">
                No data to display
            </div>
        @else
            <div class="actions">
                <a href="{{ route('create_brand') }}" class="action-link">
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
                        <th>Logo</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($brands as $brand)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ $brand->id }}</td>
                            <td>{{ $brand->brand_name }}</td>
                            <td>
                                @if($brand->brand_image == null)
                                    <img src="assets/images/products/product-default-list-350.jpeg" width="100px"/>
                                @else
                                    <img src="public/assets/images/brands/{{ $brand->brand_image }}" width="100px"/>
                                @endif
                            </td>
                            <td>{{ $brand->created_at }}</td>
                            <td>{{ $brand->updated_at }}</td>
                            <td>
                                <a href="{{ route('edit_brand', $brand->id) }}"><button class="btn btn-secondary btn-sm">Edit</button></a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
