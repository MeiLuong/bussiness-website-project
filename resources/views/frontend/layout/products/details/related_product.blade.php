<div class="container">
    <div class="row product-store">
        <div class="display-header d-flex justify-content-between pb-3">
            <h2 class="display-7 text-dark text-uppercase">Related Products</h2>
        </div>
        <div class="swiper product-swiper">
            <div class="swiper-wrapper">
                @foreach($relatedProducts as $relatedProduct)
                    @include('frontend.layout.products.list.product_item', ['product' => $relatedProduct])
                @endforeach
            </div>
        </div>
    </div>
</div>


