<div class="swiper-slide">
    <div class="product-card position-relative">
        <div class="image-holder">
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
        <div class="card-detail text-center justify-content-between align-items-baseline pt-3">
            <h3 class="card-title text-uppercase">
                <a href="/home/product/{{ $product->id }}" class="link-theme">{{ $product->product_name }}</a>
            </h3>

            @if($product->product_discount != null)

                <span class="price old-price">RM{{ $product->product_old_price }}</span>
                <span class="price-discount current-price">RM{{ $product->product_price }}</span>

            @else

                <span class="price current-price">RM{{ $product->product_price }}</span>

            @endif

        </div>
    </div>
</div>

@section('scripts')
    <script type="text/javascript">
        function addToWishlist(productID, userID) {
            if(userID == 0) {
                // alert('Login is require to add product in wishlist!');
            }
            else {
                $.ajax({
                    url: '{{ route('add_to_wishlist') }}',
                    method: "POST",
                    data: {
                        product_id:productID,
                        user_id:userID,
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
