@extends('backend.layout.master')

@section('title', 'New Adminer')

@section('body')
    <div class="row">
        <form class="admin-form" action="{{ route('post_adminer') }}" method="POST">
            @csrf
            <div class="actions">
                <button type="submit" class="action create">Save</button>
            </div>
            <div class="form-group">
                <label class="label">Name<span class="btn-require">*</span></label>
                <input type="text" placeholder="Name" id="name" class="form-controll" name="name" autofocus />
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="label">User Name<span class="btn-require">*</span>:</label>
                <input type="text" placeholder="User name" id="user_name" class="form-controll" name="user_name" />
            </div>
            <div class="form-group">
                <label class="label">Email<span class="btn-require">*</span>:</label>
                <input type="text" placeholder="Email" id="email" class="form-controll" name="email" />
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="label">Password<span class="btn-require">*</span>:</label>
                <input type="password" placeholder="Password" id="password" class="form-controll" name="password" />
                @if($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="label">Confirm Password<span class="btn-require">*</span>:</label>
                <input type="password" placeholder="Confirm password" id="confirm_password" class="form-controll" name="confirm_password" />
                @if($errors->has('confirm_password'))
                    <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label class="label">Phone:</label>
                <input type="text" placeholder="Phone number" id="phone" class="form-controll" name="phone" />
            </div>

            <div class="form-group">
                <label class="label">Status<span class="btn-require">*</span>:</label>
                <select id="level" class="form-controll" name="level">
                    <option value="0">Un active</option>
                    <option value="1">Active</option>
                </select>
            </div>

            <hr>
            <h3>Your Information</h3>
            <div class="form-group">
                <label class="label">Password<span class="btn-require">*</span>:</label>
                <input type="password" placeholder="Password" id="current_password" class="form-controll" name="current_password" />
                @if($errors->has('current_password'))
                    <span class="text-danger">{{ $errors->first('current_password') }}</span>
                @endif
            </div>

        </form>
    </div>
@endsection
