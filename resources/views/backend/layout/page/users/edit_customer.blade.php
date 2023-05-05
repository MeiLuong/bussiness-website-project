@extends('backend.layout.master')

@section('title', 'Edit Customer')
@section('body')
    <div class="row">
        <form class="admin-form" action="{{ route('update_customer', $customer->id) }}" method="POST">
            {!! csrf_field() !!}
            @method("PATCH")
            <div class="actions">
                <button type="submit" class="action update">Update</button>
            </div>
            <div class="form-group">
                <label class="label">Name<span class="btn-require">*</span></label>
                <input type="text" value="{{ $customer->name }}" placeholder="Name" id="name" class="form-controll" name="name" autofocus />
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="label">User Name:</label>
                <input type="text" value="{{ $customer->user_name }}" placeholder="User name" id="user_name" class="form-controll" name="user_name" />
            </div>
            <div class="form-group">
                <label class="label">Phone:</label>
                <input type="text" value="{{ $customer->phone }}" placeholder="Phone number" id="phone" class="form-controll" name="phone" />
            </div>
            <div class="form-group">
                <label class="label">Address:</label>
                <input type="text" value="{{ $customer->address }}" placeholder="Address" id="address" class="form-controll" name="address" />
            </div>
            <div class="form-group">
                <label class="label">Status<span class="btn-require">*</span>:</label>
                <select id="level" class="form-controll" name="level">
                    <option value="2" @if($customer->level == '2') selected @endif>Active</option>
                    <option value="3" @if($customer->level == '3') selected @endif>Un active</option>
                </select>
            </div>

        </form>
    </div>
@endsection
