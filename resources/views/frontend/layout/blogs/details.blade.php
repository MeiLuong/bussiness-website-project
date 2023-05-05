@extends('frontend.layout.master')

@section('title')
    {{ $blog->title }}
@endsection

@section('style')
    <link rel="stylesheet" href="frontend/css/pages/blogs/details_page.css" type="text/css">
@endsection

@section('body')
    <div class="container">
        <div class="row">
            <div class="page-title">
                <h3 class="title">{{ $blog->title }}</h3>
            </div>
            <div class="blog-info">
                <span class="fcp-upload3"></span>
                <span class="date">{{ date('M d, Y', strtotime($blog->created_at)) }}</span> -
                <span class="fcp-account"></span>
                <span class="name">{{ $blog->author }}</span>
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-9">
                        <div class="main-content">

                            @if($blog->image != null)
                                <div class="blog-banner">
                                    <img src="public/assets/images/blogs/{{ $blog->image }}" width="100%" class="img-fluid" />
                                </div>
                            @endif

                            <div class="blog-main-content">
                                {!! $blog->content !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="blog-link-list">
                            <div class="block-title">All Blogs</div>
                            @foreach($blogs as $blog)
                                <div class="item">
                                    <a href="{{ route('details', $blog->id) }}" class="link-theme">{{ $blog->title }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
