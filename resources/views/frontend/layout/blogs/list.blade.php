@extends('frontend.layout.master')

@section('title', 'All Blogs')

@section('style')
    <link rel="stylesheet" href="frontend/css/pages/blogs/list.css" type="text/css">
@endsection

@section('body')
    <div class="container">
        <div class="row mx-0">

            @foreach($blogs as $blog)

                <div class="blog-item col-lg-4 col-md-6">
                    <div class="blog-main-image">
                        <a href="{{ route('details', $blog->id) }}" class="blog-image-link">
                            @if($blog->image == null)
                                <img src="assets/images/products/product-default-list-350.jpeg" width="100%" class="img-fluid" />
                            @else
                                <img src="public/assets/images/blogs/{{ $blog->image }}" width="100%" class="img-fluid" />
                            @endif
                        </a>
                    </div>

                    <div class="blog-detail">

                        <div class="blog-informations">
                            <div class="create-date">
                                <span class="fcp-upload3"></span>
                                <span class="date">{{ date('M d, Y', strtotime($blog->created_at)) }}</span>
                            </div>
                            <div class="blog-actor">
                                <span class="fcp-account"></span>
                                <span class="name">{{ $blog->author }}</span>
                            </div>
                        </div>

                        <div class="blog-name">
                            <a href="{{ route('details', $blog->id) }}" class="blog-link link-theme">
                                {{ $blog->title }}
                            </a>
                        </div>

                    </div>
                </div>

            @endforeach

        </div>
    </div>
@endsection
