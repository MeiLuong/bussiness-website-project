@extends('backend.layout.master')

@section('title', 'Products')
@section('body')
    <div class="row">
        <div class="tool-bar">
            <div class="actions">
                <a href="{{ route('create_product') }}" class="action-link">
                    <button class="action add-new">Add New</button>
                </a>
            </div>
            <form action="{{ route('searchAD') }}" method="GET">
                <div class="search-group align-items-center" style="display: flex; margin-bottom: 10px">
                    <input type="text" value="{{ request('search') }}" id="search" name="search" class="text-input" placeholder="Search...">
                    <button type="submit" class="btn btn-secondary action search" style="margin-left: 5px">Search</button>
                    <a href="{{ route('products') }}" class="btn btn-secondary" style="margin-left: 5px">Reset</a>
                </div>
            </form>

        </div>
        @if($count <= 0)
            <div class="text-centert">
                No data to display
            </div>
        @else
            <div>
                <h5>Total: {{ $count }}</h5>
            </div>

            <div class="table-container">
                <table border="1" width="100%" class="table table-bordered table-striped table-responsive-stack">
                    <thead class="table-dark">
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>SKU</th>
                        <th>Old Price</th>
                        <th>Price</th>
                        <th>Discount(%)</th>
                        <th>Status</th>
                        <th>Quantity</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>
                                @if($product->product_image == null)
                                    <img src="assets/images/products/product-default-list-350.jpeg" width="100px"/>
                                @else
                                    <img src="public/assets/images/products/{{ $product->product_image }}" width="100px"/>
                                @endif
                            </td>
                            <td>{{ $product->product_sku }}</td>
                            <td>{{ $product->product_old_price }}</td>
                            <td>{{ $product->product_price }}</td>
                            <td>{{ $product->product_discount }}</td>
                            <td>
                                @if($product->product_status == '1')
                                    Instock
                                @else
                                    Out of Stock
                                @endif
                            </td>
                            <td>{{ $product->product_qty }}</td>
                            <td>{{ $product->created_at }}</td>
                            <td>{{ $product->updated_at }}</td>
                            <td>
                                <a href="{{ route('edit_product', $product->id) }}"><button class="btn btn-secondary btn-sm">Edit</button></a>
                            </td>
                            <td>
                                <form action="{{ route('delete_product', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action delete btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this product?')">Delete</button>
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
