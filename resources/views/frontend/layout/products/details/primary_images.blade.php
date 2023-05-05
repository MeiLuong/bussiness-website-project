<div class = "img-display">
    <div class = "img-showcase">
        @if($product->product_image == null)
            <img src="assets/images/products/product-default-list-350.jpeg" width="100%" class="img-fluid"/>
        @else
            <img src="public/assets/images/products/{{ $product->product_image }}" width="100%" class="img-fluid"/>
        @endif
    </div>
</div>
