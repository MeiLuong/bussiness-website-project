@extends('backend.layout.master')

@section('title', 'Edit Adminer')

@section('body')
    <div class="row">
        <form class="admin-form" action="{{ route('update_adminer', $adminer->id) }}" method="POST">
            {!! csrf_field() !!}
            @method("PATCH")

            <div class="actions">
                <button type="submit" class="action create">Update</button>
            </div>
            <div class="form-group">
                <label class="label">Name<span class="btn-require">*</span></label>
                <input type="text" value="{{ $adminer->name }}" placeholder="Name" id="name" class="form-controll" name="name" autofocus />
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="label">User Name<span class="btn-require">*</span>:</label>
                <input type="text" value="{{ $adminer->user_name }}" placeholder="User name" id="user_name" class="form-controll" name="user_name" />
            </div>
            <div class="form-group">
                <label class="label">Phone:</label>
                <input type="text" value="{{ $adminer->phone }}" placeholder="Phone number" id="phone" class="form-controll" name="phone" />
            </div>

            <div class="form-group">
                <label class="label">Status<span class="btn-require">*</span>:</label>
                <select id="level" class="form-controll" name="level">
                    <option value="0" @if($adminer->level == '0') selected @endif>Un active</option>
                    <option value="1" @if($adminer->level == '1') selected @endif>Active</option>
                </select>
            </div>

            <hr>
            <h3>Your Information</h3>
            <div class="form-group">
                <label class="label">Password<span class="btn-require">*</span>:</label>
                <input type="password" value="" placeholder="Password" id="current_password" class="form-controll" name="current_password" />
                @if($errors->has('current_password'))
                    <span class="text-danger">{{ $errors->first('current_password') }}</span>
                @endif
            </div>

        </form>
    </div>
@endsection
