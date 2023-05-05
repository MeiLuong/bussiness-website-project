@extends('frontend.layout.master')
@section('title')
    {{ $product->product_name }}
@endsection

@section('breadcrumbs')
    <div class="breadcrumbs-content">
        <span class="icon fcp-home"></span>
        <span>Home</span> / {{ $product->category->category_name }} / {{ $product->product_name }}
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="frontend/css/products/details_page.css" type="text/css">
@endsection

@section('scripts')
    <script src="frontend/js/web/products/details.js"></script>
@endsection


@section('body')

    <div class="main-content product-page-content product-{{ $product->id }}">
        <div class="container">
            <div class="row">
                <div class = "card-wrapper">
                    <div class = "card">
                        <div class="product-image-column product-imgs">
                            @include('frontend.layout.products.details.primary_images')
                        </div>

                        <div class="product-primary-column product-content">
                            @include('frontend.layout.products.details.primary_infor')
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="product-lower-primary-column">
                    @include('frontend.layout.products.details.secondary_content')
                </div>

                <div class="product-lower-secondary-column">
                    @include('frontend.layout.products.details.related_product')
                </div>
            </div>

        </div>
    </div>

@endsection




