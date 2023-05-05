@extends('frontend.layout.master')
@section('title', 'Focus Point')

@section('body')

    <section id="billboard" class="position-relative overflow-hidden bg-light-blue">
        @include('frontend.layout.block.slider')
    </section>
    <section id="company-services" class="padding-large">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 pb-3">
                    <div class="icon-box d-flex">
                        <div class="icon-box-icon pe-3 pb-3">
                            <span class="fcp-truck1"></span>
                        </div>
                        <div class="icon-box-content">
                            <h3 class="card-title text-uppercase text-dark">Free delivery</h3>
                            <p>Consectetur adipi elit lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 pb-3">
                    <div class="icon-box d-flex">
                        <div class="icon-box-icon pe-3 pb-3">
                            <span class="fcp-award1"></span>
                        </div>
                        <div class="icon-box-content">
                            <h3 class="card-title text-uppercase text-dark">Quality guarantee</h3>
                            <p>Dolor sit amet orem ipsu mcons ectetur adipi elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 pb-3">
                    <div class="icon-box d-flex">
                        <div class="icon-box-icon pe-3 pb-3">
                            <span class="fcp-files-empty"></span>
                        </div>
                        <div class="icon-box-content">
                            <h3 class="card-title text-uppercase text-dark">Daily offers</h3>
                            <p>Amet consectetur adipi elit loreme ipsum dolor sit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 pb-3">
                    <div class="icon-box d-flex">
                        <div class="icon-box-icon pe-3 pb-3">
                            <span class="fcp-shield1"></span>
                        </div>
                        <div class="icon-box-content">
                            <h3 class="card-title text-uppercase text-dark">100% secure payment</h3>
                            <p>Rem Lopsum dolor sit amet, consectetur adipi elit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="hot-deals" class="product-store position-relative padding-large no-padding-top">

        @include('frontend.layout.block.product_features')

    </section>
    <section id="mobile-products" class="product-store position-relative padding-large no-padding-top">

        @include('frontend.layout.block.hot_deals')

    </section>

    <section id="yearly-sale" class="bg-light-blue overflow-hidden mt-5">
        <div class="row d-flex flex-wrap align-items-center">
            <img src="public/assets/images/banner/1optom_cover440x600_website_banner_.jpg"/>
        </div>
    </section>
    <section id="latest-blog" class="padding-large">
        @include('.frontend.layout.block.blogs')
    </section>
    <section id="testimonials" class="position-relative">
        <div class="container">
            <div class="row">
                <div class="review-content position-relative">
                    <div class="swiper testimonial-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide text-center d-flex justify-content-center">
                                <div class="review-item col-md-10">
                                    <i class="icon icon-review"></i>
                                    <blockquote>
                                        About Us
                                    </blockquote>
                                    <div class="author-detail">
                                        <div class="name text-dark text-uppercase pt-2">
                                            Focus Point is officially recognized by the Malaysia Book of Records as the largest optical retail chain store in Malaysia and also the first and only optical retail chain store to be listed in Bursa Malaysia. With more than 180 outlets nationwide and more than 230 eye care professionals ready to serve you. Customers have a wide range of fashionable eyewear to choose from at the concept stores such as Focus Point, Focus Point Signature, Focus Point Concept Store, Focus Point Outlet, Focus Point Lifestyle, Whoosh, Opulence, Eyefont, Solariz and i-Focus.
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </section>

@endsection
