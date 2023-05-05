@extends('backend.layout.master')

@section('title', 'Edit Blog')

@section('body')
    <div class="row">
        <form class="admin-form" action="{{ route('update_blog', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="actions">
                <button type="submit" class="action update">Update</button>
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
                <label class="label">Title<span class="btn-require">*</span></label>
                <input type="text" value="{{ $blog->title }}" placeholder="Title" id="title" class="form-controll" name="title" autofocus />
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="label">Author Name<span class="btn-require">*</span>:</label>
                <input type="text" value="{{ $blog->author }}" placeholder="User name" id="author" class="form-controll" name="author" />
                @if($errors->has('author'))
                    <span class="text-danger">{{ $errors->first('author') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="label">Image:</label>
                <input type="file" value="{{ $blog->image }}" placeholder="" id="image" class="form-controll" name="image" />
                <img src="public/assets/images/blogs/{{ $blog->image }}" width="200px">
            </div>
{{--            <div class="form-group">--}}
{{--                <label class="label">Category<span class="btn-require">*</span>:</label>--}}
{{--                <select id="select_action" name="select_action" class="form-controll" onchange="getCategory()">--}}
{{--                    @foreach($categories as $category)--}}
{{--                        <option value="{{ $category->id }}" @if($blog->category_id == $category->id) selected @endif>{{ $category->category_name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--                <input type="hidden" value="{{ $blog->category_id }}" name="category_id" id="category_id" class="form-control">--}}

{{--            </div>--}}
            <div class="form-group">
                <label class="label">Content:</label>
                <textarea class="ckeditor form-control" name="content" id="content" cols="30" rows="10" placeholder="Test">
                    {{ $blog->content }}
                </textarea>
            </div>

        </form>
    </div>

{{--    <script>--}}
{{--        var select = document.getElementById('select_action');--}}
{{--        var value = select.options[select.selectedIndex].value;--}}
{{--        document.getElementById('category_id').value= value;--}}

{{--        function getCategory() {--}}
{{--            var select = document.getElementById('select_action');--}}
{{--            var value = select.options[select.selectedIndex].value;--}}

{{--            document.getElementById('category_id').value= value;--}}
{{--        }--}}
{{--    </script>--}}
@endsection
