@extends('backend.layout.master')

@section('title', 'New Banner')

@section('body')
    <div class="row">
        <form class="admin-form" action="{{ route('post_banner') }}" method="POST" enctype="multipart/form-data">
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
                <label class="label">Title<span class="btn-require">*</span>:</label>
                <input type="text" placeholder="Title" id="title" class="form-controll" name="title" autofocus />
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="label">Image:</label>
                <input type="file" id="image" class="form-controll" name="image" />
            </div>
            <div class="form-group">
                <label class="label">Status<span class="btn-require">*</span>:</label>
                <select id="status" class="form-controll" name="status">
                    <option value="1">Active</option>
                    <option value="0">Un active</option>
                </select>
            </div>

        </form>
    </div>
@endsection
