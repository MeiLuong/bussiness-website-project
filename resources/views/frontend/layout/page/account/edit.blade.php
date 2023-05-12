@extends('frontend.layout.master')

@section('title', 'Edit Information')

@section('breadcrumbs')
    <div class="breadcrumbs-content">
        <span class="icon fcp-home"></span>
        <span>Home</span> / Account / Edit Information
    </div>
@endsection

@section('body')
    <div class="container">
        <div class="page-title text-center">
            <h3 class="title">Edit Information</h3>
        </div>
        <div class="row">
            <div class="col-3">
                @include('frontend.layout.block.sidebar.account_sidebar')
            </div>
            <div class="col-9">
                <form class="admin-form" action="{{ route('update_infor', \Illuminate\Support\Facades\Auth::user()->id) }}" method="POST">
                    {!! csrf_field() !!}
                    @method("PATCH")
                    <div class="form-group">
                        <label class="label">Name<span class="btn-require">*</span></label>
                        <input type="text" value="{{ $user->name }}" placeholder="Name" id="name" class="form-controll" name="name" autofocus />
                        @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="label">User Name:</label>
                        <input type="text" value="{{ $user->user_name }}" placeholder="User name" id="user_name" class="form-controll" name="user_name" />
                        @if($errors->has('user_name'))
                            <span class="text-danger">{{ $errors->first('user_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="label">Phone:</label>
                        <input type="text" value="{{ $user->phone }}" placeholder="Phone number" id="phone" class="form-controll" name="phone" />
                        @if($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="label">Address:</label>
                        <input type="text" value="{{ $user->address }}" placeholder="Address" id="address" class="form-controll" name="address" />
                        @if($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
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
        input[type=text], select, textarea{
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
