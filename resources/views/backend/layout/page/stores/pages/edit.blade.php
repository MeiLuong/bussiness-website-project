@extends('backend.layout.master')

@section('title', 'Edit Page')

@section('body')
    <div class="row">
        <form class="admin-form" action="{{ route('update_page', $page->id) }}" method="POST">
            {!! csrf_field() !!}
            @method("PATCH")

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
                <label class="label">Page title<span class="btn-require">*</span>:</label>
                <input type="text" value="{{ $page->title }}" onchange="getValue()" placeholder="Name" id="title" class="form-controll" name="title" autofocus />
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="label">Search Url<span class="btn-require">*</span>:</label>
                <input type="text" value="{{ $page->url }}" id="url" class="form-controll" name="url" />
                @if($errors->has('url'))
                    <span class="text-danger">{{ $errors->first('url') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="label">Status<span class="btn-require">*</span>:</label>
                <select id="status" class="form-controll" name="status">
                    <option value="1" @if($page->status == 1) selected @endif>Active</option>
                    <option value="0" @if($page->status == 0) selected @endif>Un active</option>
                </select>
            </div>
            <div class="form-group">
                <label class="label">Content:</label>
                <textarea class="ckeditor form-control" name="content" id="content" cols="30" rows="10" placeholder="">
                    {{ $page->content }}
                </textarea>
            </div>

        </form>
    </div>
@endsection
