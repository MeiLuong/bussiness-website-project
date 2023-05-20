@extends('frontend.layout.master')

@section('breadcrumbs')
    <div class="breadcrumbs-content">
        <span class="icon fcp-home"></span>
        <span>Home</span> / Account / My Wishlist
    </div>
@endsection

@section('body')
    <div class="main-content">
        <div class="container">
            <div class="page-title text-center">
                <h3 class="title">Wishlist</h3>
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-3">
                        @include('frontend.layout.block.sidebar.account_sidebar ')
                    </div>
                    <div class="col-9">
                        @if(count($wishlist) <= 0)
                            <div class="message">
                                No item on wishlist!
                            </div>
                        @else
                            <ul class="row products wishlist-items items">
                                @foreach($wishlist as $key=>$item)
                                    <li class="product wishlist-item item product-item col-lg-4 col-md-6">
                                        <div class="product-item-info">
                                            <div class="product-image">
                                                <a href="/home/product/{{ $item->id }}" class="image-link">

                                                    @if($item->product->product_image == null)
                                                        <img src="assets/images/products/product-default-list-350.jpeg" width="100%"/>
                                                    @else
                                                        <img src="public/assets/images/products/{{ $item->product->product_image }}" width="100%"/>
                                                    @endif
                                                </a>
                                                @if($item->product->product_discount != null)
                                                    <span class="sale btn-sale">{{ $item->product->product_discount }}%</span>
                                                @endif

                                            </div>

                                            <div class="product-infor">
                                                <div class="product-name name">
                                                    <a href="/home/product/{{ $item->id }}" class="product-link link-theme">
                                                        {{ $item->product->product_name }}
                                                    </a>
                                                </div>

                                                <div class="product-price price">
                                                    @if($item->product_discount != null)

                                                        <span class="old-price mr-2">RM{{ $item->product->product_old_price }}</span>
                                                        <span class="current-price font-weight-bold ">RM{{ $item->product->product_price }}</span>

                                                    @else

                                                        <span class="current-price font-weight-bold">RM{{ $item->product->product_price }}</span>

                                                    @endif
                                                </div>

                                                <div class="row">
                                                    <div class="actions col-6">
                                                        @if($item->product->product_status == 1)
                                                            <form action="{{ route('add_to_cart', $item->product_id) }}" method="POST" class="post-form">
                                                                @csrf
                                                                <input type = "hidden" id="product_qty" name="product_qty" min = "0" value = "1">
                                                                <input type = "hidden" id="product_stock" name="product_stock" min = "0" value = "{{ $item->product->product_qty }}">
                                                                <button type = "submit" class = "btn btn-sm btn-black action add-to-cart">Add to Cart</button>
                                                            </form>
                                                        @else
                                                            <p class="text-danger">Out of stock</p>
                                                        @endif
                                                    </div>
                                                    <div class="wishlist-actions col-6">
                                                        <button class="action remove" onclick="removeItem('{{ $item->product->id }}')">Remove</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function removeItem(product_id) {
            $.ajax({
                url: '{{ route('remove_wishlist') }}',
                method: "GET",
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: product_id
                },
                success: function (response) {
                    window.location.reload();
                },
                error: function (error) {
                    window.location.reload();
                }
            });
        }
    </script>
@endsection
