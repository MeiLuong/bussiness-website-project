@extends('backend.layout.master')

@section('title', 'Edit Adminer')

@section('body')
    <div class="row">
        <form class="admin-form" action="{{ route('change_passwordAD') }}" method="POST">
            @csrf

            <div class="actions">
                <button type="submit" class="action create">Update</button>
            </div>

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


        </form>

    </div>
@endsection
