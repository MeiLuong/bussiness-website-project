@extends('frontend.layout.master')

@section('body')
    <div class="main-content">
        <div class="container">
            <div class="page-title">
                <h3 class="title">Wishlist</h3>
            </div>
            <div class="page-content">
                <div class="row">

                    @include('frontend.layout.block.sidebar.account_sidebar ')

                    @if(count($wishlist) <= 0)
                        <div class="message">
                            No item on wishlist!
                        </div>
                    @else
                        <ul class="products wishlist-items items">
                            @foreach($wishlist as $key=>$item)
                                <li class="product wishlist-item item product-item col-lg-4 col-md-6">
                                    <div class="product-item-info">
                                        <div class="product-image">
                                            <a href="/home/product/{{ $item->id }}" class="image-link">
                                                {{--                                    @if($item->product_discount != null)--}}
                                                <span class="label">Sale</span>
                                                {{--                                    @endif--}}

                                                <img class="main-image" src="frontend/img/products/20-146-c2-1.jpg" alt="">
                                            </a>

                                        </div>

                                        <div class="product-infor">
                                            <div class="product-name name">
                                                <a href="/home/product/{{ $item->id }}" class="product-link">
                                                    {{ $item->product->product_name }}
                                                </a>
                                            </div>

                                            <div class="product-reviews stars">
                                    <span>
                                        <img src="assets/star.png" alt="">
                                    </span>
                                                <span>
                                        <img src="assets/star.png" alt="">
                                    </span>
                                                <span>
                                        <img src="assets/star.png" alt="">
                                    </span>
                                                <span>
                                        <img src="assets/star.png" alt="">
                                    </span>
                                                <span>
                                        <img src="assets/star.png" alt="">
                                    </span>
                                                {{--                                        <span class="count-reviews">--}}
                                                {{--                                            @if(count($item->productReviews) > 0)--}}
                                                {{--                                                <span class="number">--}}
                                                {{--                                                    {{ count($item->productReviews) }}--}}
                                                {{--                                                </span>--}}
                                                {{--                                                @if(count($item->productReviews) > 1)--}}
                                                {{--                                                    <span class="label">reviews</span>--}}
                                                {{--                                                @else--}}
                                                {{--                                                    <span class="label">review</span>--}}
                                                {{--                                                @endif--}}

                                                {{--                                            @endif--}}
                                                {{--                                        </span>--}}

                                            </div>

                                            <div class="product-price price">
                                                @if($item->product_discount != null)

                                                    <span class="price-discount">RM{{ $item->product->product_discount }}</span>
                                                    <span class="price">RM{{ $item->product->product_price }}</span>

                                                @else

                                                    <span class="price">RM{{ $item->product->product_price }}</span>

                                                @endif
                                            </div>

                                            <div class="actions">
                                                <form action="{{ route('add_to_cart', $item->id) }}" method="POST" class="post-form">
                                                    @csrf
                                                    <input type = "hidden" id="product_qty" name="product_qty" min = "0" value = "1">
                                                    <button type = "submit" class = "btn btn-sm btn-black action add-to-cart">Add to Cart</button>
                                                </form>
                                            </div>
                                            <div class="wishlist-actions">
                                                <button class="action remove" onclick="removeItem('{{ $item->product->id }}')">Remove</button>
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
