<div class="swiper main-swiper">
    <div class="swiper-wrapper">

        @foreach($banners as $banner)
            <div class="swiper-slide">
                @if($banner->image == null)
                    <img width="100%" src="assets/images/banner/april-miacare-promo_1440x600.png" alt="banner">
                @else
                    <img width="100%" src="public/assets/images/banner/{{ $banner->image }}" alt="banner"/>
                @endif

            </div>
        @endforeach

    </div>
</div>
<div class="swiper-icon swiper-arrow swiper-arrow-prev">
    <button class="chevron-left fcp-arrow_back_ios"></button>
</div>
<div class="swiper-icon swiper-arrow swiper-arrow-next">
    <button class="chevron-right fcp-arrow_forward_ios"></button>
</div>
