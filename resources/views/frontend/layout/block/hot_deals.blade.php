<div class="container">
    <div class="row">
        <div class="display-header d-flex justify-content-between pb-3">
            <h2 class="display-7 text-dark text-uppercase">Hot Deals</h2>
            <div class="btn-right">
                <a href="/home" class="btn btn-medium btn-normal text-uppercase">View more</a>
            </div>
        </div>
        <div class="swiper product-swiper">
            <div class="swiper-wrapper">
                @foreach($hotDeals as $hotDeal)
                    @include('frontend.layout.products.list.product_item', ['product' => $hotDeal])
                @endforeach
            </div>
        </div>
    </div>
</div>

