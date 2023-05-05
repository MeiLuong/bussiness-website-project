@extends('backend.layout.master')

@section('title', 'Edit Brand')

@section('body')
    <div class="row">
        <form class="admin-form" action="{{ route('update_banner', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="actions">
                <button type="submit" class="action create">Update</button>
            </div>
            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <label class="label">Title<span class="btn-require">*</span>:</label>
                <input type="text" value="{{ $banner->title }}" placeholder="Title" id="title" class="form-controll" name="title" autofocus />
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="label">Image:</label>
                <input type="file" id="image" class="form-controll" name="image" />
                @if($banner->image == null)
                    <img src="assets/images/products/product-default-list-350.jpeg" width="100px"/>
                @else
                    <img src="public/assets/images/banner/{{ $banner->image }}" width="100px"/>
                @endif
            </div>
            <div class="form-group">
                <label class="label">Status<span class="btn-require">*</span>:</label>
                <select id="status" class="form-controll" name="status">
                    <option value="1" @if($banner->status == 1) selected @endif>Active</option>
                    <option value="0" @if($banner->status == 0) selected @endif>Un active</option>
                </select>
            </div>

        </form>
    </div>
@endsection
