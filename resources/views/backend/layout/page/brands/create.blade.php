@extends('backend.layout.master')

@section('title', 'New Brand')

@section('body')
    <div class="row">
        <form class="admin-form" action="{{ route('post_brand') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="actions">
                <button type="submit" class="action create">Save</button>
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
                <label class="label">Brand Name<span class="btn-require">*</span>:</label>
                <input type="text" placeholder="Name" id="brand_name" class="form-controll" name="brand_name" autofocus />
                @if($errors->has('brand_name'))
                    <span class="text-danger">{{ $errors->first('brand_name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="label">Brand Logo:</label>
                <input type="file" id="brand_image" class="form-controll" name="brand_image" />
            </div>

        </form>
    </div>
@endsection
