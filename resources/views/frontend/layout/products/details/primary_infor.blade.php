<h2 class = "product-title">{{ $product->product_name }}</h2>
<a href = "#" class = "product-link">{{ $product->category->category_name }}</a>
<div class = "product-rating">
    @if(count($product->productReviews) > 0)
        @for($i = 1; $i <= 5; $i++)
            @if($i <= $avgRating)
                <i class="star fcp-star-full"></i>
            @else
                <i class="star fcp-star-empty"></i>
            @endif

        @endfor
        <a href="home/product/{{ $product->id }}#tab2" class="action to-review">
            <span class="value">{{ count($product->productReviews) }}</span>

            @if(count($product->productReviews) > 1)
                <span class="label">reviews</span>
            @else
                <span class="label">review</span>
            @endif
        </a>
    @else
        <a href="home/product/{{ $product->id }}#tab2" class="action review theme-color">Be the first to review this product</a>
    @endif
</div>

<div class = "product-price">
    @if($product->product_discount != null)
        <p class = "last-price">Old Price: <span>RM{{ $product->product_old_price }}</span></p>
        <p class = "new-price">Now only: <span>RM{{ $product->product_price }}</span></p>
    @else
        <p class = "new-price">Price: <span>RM{{ $product->product_price }}</span></p>
    @endif

</div>

<div class = "product-detail">
    {!! $product->product_short_description !!}
</div>

<div class = "purchase-info">
    @if($product->product_status == 1)
        <form action="{{ route('add_to_cart', $product->id) }}" method="POST" class="post-form">
            @csrf

            <input type = "number" id="product_qty" name="product_qty" min = "0" value = "1">
            <input type = "hidden" id="product_stock" name="product_stock" min = "0" value = "{{ $product->product_qty }}">
            <button type = "submit" class = "btn btn-full btn-primary">Add to Cart</button>
        </form>
    @else
        <p class="text-danger">Out of stock</p>
    @endif

</div>

<div class = "social-links">
    <a href = "#">
        <i class = "fab fcp-facebook2"></i>
    </a>
    <a href = "#">
        <i class = "fab fcp-twitter1"></i>
    </a>
    <a href = "#">
        <i class = "fab fcp-instagram"></i>
    </a>
    <a href = "#">
        <i class = "fab fcp-whatsapp"></i>
    </a>
    <a href = "#">
        <i class = "fab fcp-pinterest"></i>
    </a>
</div>



