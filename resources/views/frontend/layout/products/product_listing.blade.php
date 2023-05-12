@extends('frontend.layout.master')
@section('title', 'Products')

@section('breadcrumbs')
    <div class="breadcrumbs-content">
        <span class="icon fcp-home"></span>
        <span>Home</span> / Products
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="frontend/css/products/listing_page.css" type="text/css">
@endsection

@section('scripts')
    <script type="text/javascript" src="frontend/js/web/products/sidebar_listing.js"></script>

    <script type="text/javascript">
        function addToWishlist(productID, userID) {
            if (userID == 0) {
                // alert('Login is require to add product in wishlist!');
            } else {
                $.ajax({
                    url: '{{ route('add_to_wishlist') }}',
                    method: "POST",
                    data: {
                        product_id: productID,
                        user_id: userID,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        }
    </script>
@endsection

@section('body')
    <div class="container">

        <div id="content" class="">
            <div id="filterbar" class="collapse">
                @include('frontend.layout.products.sidebar.sidebar_listing')
            </div>
            <div id="products">
                <div class="row">
                    <div class="toolbar toolbar-products toolbar-top">
                        <form action="">
                            <div class="select-options">
                                <select name="sort_by" class="prd-sort" onchange="this.form.submit();">
                                    <option {{ request('sort_by') == 'latest' ? 'selected' : '' }} value="latest">
                                        Sorting: Latest
                                    </option>
                                    <option {{ request('sort_by') == 'oldest' ? 'selected' : '' }} value="oldest">
                                        Sorting: Oldest
                                    </option>
                                    <option
                                        {{ request('sort_by') == 'name-ascending' ? 'selected' : '' }} value="name-ascending">
                                        Sorting: A - Z
                                    </option>
                                    <option
                                        {{ request('sort_by') == 'name-descending' ? 'selected' : '' }} value="name-descending">
                                        Sorting: Z - A
                                    </option>
                                    <option
                                        {{ request('sort_by') == 'price-ascending' ? 'selected' : '' }} value="price-ascending">
                                        Sorting: Price Ascending
                                    </option>
                                    <option
                                        {{ request('sort_by') == 'price-descending' ? 'selected' : '' }} value="price-descending">
                                        Sorting: Price Decrease
                                    </option>
                                </select>

                                <select name="show" class="prd-show" onchange="this.form.submit();">
                                    <option {{ request('show') == '9' ? 'selected' : '' }} value="9">Show: 9</option>
                                    <option {{ request('show') == '15' ? 'selected' : '' }} value="15">Show: 15</option>
                                    <option {{ request('show') == '20' ? 'selected' : '' }} value="20">Show: 20</option>
                                    <option {{ request('show') == '30' ? 'selected' : '' }} value="30">Show: 30</option>
                                    <option {{ request('show') == '40' ? 'selected' : '' }} value="40">Show: 40</option>
                                </select>
                                <label class="label">per page</label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mx-0">
                    @foreach($products as $product)
                        <div class="product-item col-lg-4 col-md-6">
                            <div class="product-info card d-flex flex-column align-items-center">
                                <div class="card-img">
                                    @if($product->product_image == null)
                                        <img src="assets/images/products/product-default-list-350.jpeg" width="100%" class="img-fluid"/>
                                    @else
                                        <img src="public/assets/images/products/{{ $product->product_image }}" width="100%" class="img-fluid"/>
                                    @endif
                                </div>
                                <div class="cart-concern position-absolute">
                                    <div class="cart-button d-flex">
                                        <a href="/home/product/{{ $product->id }}" class="btn btn-black action view-details">
                                            <span class="icon fcp-search1"></span>
                                            <span class="label hidden">View</span>
                                        </a>

                                        <form action="{{ route('add_to_cart', $product->id) }}" method="POST" class="post-form">
                                            @csrf
                                            <input type = "hidden" id="product_qty" name="product_qty" min = "0" value = "1">
                                            <button type = "submit" class = "btn btn-medium btn-black action add-to-cart">Add to Cart</button>
                                        </form>

                                        @auth
                                            <a href="javascript:void(0)" onclick="addToWishlist('{{ $product->id }}', '{{ \Illuminate\Support\Facades\Auth::user()->id }}')" class="btn btn-black action add-to-wishlist">
                                                <span class="icon fcp-heart-o"></span>
                                                <span class="label hidden">Wishlist</span>
                                            </a>
                                        @endauth

                                        @guest
                                            <a href="{{ route('login') }}" onclick="addToWishlist('{{ $product->id }}', '0')" class="btn btn-black action add-to-wishlist">
                                                <span class="icon fcp-heart-o"></span>
                                                <span class="label hidden">Wishlist</span>
                                            </a>
                                        @endguest
                                    </div>
                                </div>
                                <div class="card-body pt-5">
                                    <div class="product-name">
                                        <a href="/home/product/{{ $product->id }}" class="link-theme">{{ $product->product_name }}</a>
                                    </div>
                                    <div class="d-flex align-items-center price">
                                        @if($product->product_discount != null)

                                            <span class="old-price mr-2">RM{{ $product->product_old_price }}</span>
                                            <span class="current-price font-weight-bold ">RM{{ $product->product_price }}</span>

                                        @else

                                            <span class="current-price font-weight-bold">RM{{ $product->product_price }}</span>

                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="pager" style="margin-top: 20px">
                        {{ $products->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection


