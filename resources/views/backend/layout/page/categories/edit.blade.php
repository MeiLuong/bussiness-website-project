@extends('backend.layout.master')

@section('title', 'Edit Category')

@section('body')
    <div class="row">
        <form class="admin-form" action="{{ route('update_category', $category->id) }}" method="POST" enctype="multipart/form-data">
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
                <label class="label">Category Name<span class="btn-require">*</span>:</label>
                <input type="text" value="{{ $category->category_name }}" placeholder="Name" id="category_name" class="form-controll" name="category_name" autofocus />
                @if($errors->has('category_name'))
                    <span class="text-danger">{{ $errors->first('category_name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="label">Category Image:</label>
                <input type="file" value="{{ $category->category_image }}" id="category_image" class="form-controll" name="category_image" />
                <img src="public/assets/images/categories/{{ $category->category_image }}"/>
            </div>
            <div class="form-group">
                <label class="label">Description:</label>
                <textarea class="ckeditor form-control" name="category_description" id="category_description" cols="30" rows="10" placeholder="">
                    {{ $category->category_description }}
                </textarea>
            </div>

        </form>
    </div>
@endsection
