@extends('frontend.layout.master')

@section('title', 'Account')

@section('breadcrumbs')
    <div class="breadcrumbs-content">
        <span class="icon fcp-home"></span>
        <span>Home</span> / Account
    </div>
@endsection

@section('body')
    <div class="main-content account-content dashboard">
        <div class="container">
            <div class="page-title text-center">
                <h3 class="title">My Account</h3>
            </div>
            <div class="row">
                <div class="col-3">
                    @include('frontend.layout.block.sidebar.account_sidebar')
                </div>
                <div class="col-9">
                    <div class="block content">
                        <div class="block-title">
                            <h3 class="title">Account Infomation</h3>
                        </div>
                        <div class="block-content">
                            <p class="name">
                                <span class="label">Name:</span>
                                <span class="value">{{ \Illuminate\Support\Facades\Auth::user()->name }}</span>
                            </p>
                            <p class="phone">
                                <span class="label">Phone number:</span>
                                <span class="value">{{ \Illuminate\Support\Facades\Auth::user()->phone }}</span>
                            </p>
                            <p class="email">
                                <span class="label">Email address:</span>
                                <span class="value">{{ \Illuminate\Support\Facades\Auth::user()->email }}</span>
                            </p>
                            <p class="address">
                                <span class="label">Address:</span>
                                <span class="value">{{ \Illuminate\Support\Facades\Auth::user()->address }}</span>
                            </p>
                            <a href="{{ route('edit_infor', \Illuminate\Support\Facades\Auth::user()->id) }}" class="btn btn-secondary edit">
                                Edit
                            </a>
                            <a href="{{ route('change_password') }}" class="btn btn-secondary change-password">
                                Change Password
                            </a>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

