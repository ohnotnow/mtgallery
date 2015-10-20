@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
            <h3>Edit Blog
                <span style="float:right">
                    <a class="btn btn-danger" href="/admin/blog/{{ $blog->id }}/delete">Delete Blog</a>
                </span>
            </h3>
        {!! Form::model($blog, array('url' => "/admin/blog/{$blog->id}/edit")) !!}
                <div class="form-group">
                    <label for="name">Blog Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $blog->title }}">
                </div>
                <div class="form-group">
                    <label for="name">Blog</label>
                    <textarea name="body" class="form-control" rows="10">{{ $blog->body }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary" id="submit">Update blog</button>
                <p class=" text-right"></p>
        {!! Form::close() !!}
        <h3>Add Photos</h3>
        {!! Form::open(array('url' => "/admin/blog/{$blog->id}/addphoto", 'class' => 'dropzone')) !!}
        {!! Form::close() !!}
    </div>
</div>
<script src="{!! asset('dropzone.js') !!}"></script>
@endsection
