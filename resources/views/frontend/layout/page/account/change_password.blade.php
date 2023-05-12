@extends('frontend.layout.master')

@section('title', 'Change Password')

@section('breadcrumbs')
    <div class="breadcrumbs-content">
        <span class="icon fcp-home"></span>
        <span>Home</span> / Account / Change Password
    </div>
@endsection

@section('body')
    <div class="container">
        <div class="page-title text-center">
            <h3 class="title">Change Password</h3>
        </div>
        <div class="row">
            <div class="col-3">
                @include('frontend.layout.block.sidebar.account_sidebar')
            </div>
            <div class="col-9">
                <form class="admin-form" action="{{ route('change_password') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="label">Current Password<span class="btn-require">*</span></label>
                        <input type="password" value="" placeholder="" id="current_password" class="form-controll" name="current_password" autofocus />
                        @if($errors->has('current_password'))
                            <span class="text-danger">{{ $errors->first('current_password') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="label">New Password<span class="btn-require">*</span>:</label>
                        <input type="password" value="" placeholder="" id="password" class="form-controll" name="password" />
                        @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="label">Confirm Password<span class="btn-require">*</span>:</label>
                        <input type="password" value="" placeholder="" id="confirm_password" class="form-controll" name="confirm_password" />
                        @if($errors->has('confirm_password'))
                            <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                        @endif
                    </div>

                    <div class="actions" style="margin-top: 20px;">
                        <button type="submit" class="btn btn-secondary action update">Update</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection

@section('style')
    <style>
        /* Style inputs, select elements and textareas */
        input[type=password], select, textarea{
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            resize: vertical;
        }

        /* Style the label to display next to the inputs */
        label {
            padding: 12px 12px 12px 0;
            display: inline-block;
        }

        /* Style the submit button */
        input[type=submit] {
            background-color: #04AA6D;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
            .col-25, .col-75, input[type=submit] {
                width: 100%;
                margin-top: 0;
            }
        }
    </style>
@endsection
