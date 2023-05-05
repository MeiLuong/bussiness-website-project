@extends('frontend.layout.master')

@section('body')
    <div class="main-content account-content dashboard">
        <div class="container">
            <div class="row">

                @include('frontend.layout.block.sidebar.account_sidebar')

                <div class="content">
                    <h1>
                        content accountß
                    </h1>
                </div>
            </div>
        </div>
    </div>
@endsection

