@extends('frontend.layout.master')

@section('title')
    {{ $page->title }}
@endsection

@section('body')
    <div class="main-content" style="padding: 40px 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="page-title">
                            <h3 class="title">{{ $page->title }}</h3>
                        </div>
                        <div class="page-content">
                            {!! $page->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
