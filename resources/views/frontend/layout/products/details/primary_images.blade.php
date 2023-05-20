<div class = "img-display">
    <div class = "product-image img-showcase">
        @if($product->product_image == null)
            <img src="assets/images/products/product-default-list-350.jpeg" width="100%" class="img-fluid"/>
        @else
            <img src="public/assets/images/products/{{ $product->product_image }}" width="100%" class="img-fluid"/>
        @endif

            @if($product->product_discount != null)
                <span class="sale btn-sale">{{ $product->product_discount }}%</span>
            @endif
    </div>
</div>
