@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
            <h3>Edit Blog
                <span style="float:right">
                    <a class="btn btn-danger" href="{!! route('admin.delete_blog', $blog->id) !!}">Delete Blog</a>
                </span>
            </h3>
        {!! Form::model($blog, ['route' => ["admin.update_blog", $blog->id]]) !!}
                <div class="form-group">
                    <label for="name">Blog Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $blog->title }}">
                </div>
                <div class="form-group">
                    <label for="name">Blog</label>
                    <textarea name="body" class="form-control" rows="10">{{ $blog->body }}</textarea>
                </div>
                <div class="form-group">
                    <label for="name">Publish At</label>
                    <input type="text" id="publish_at" name="publish_at" class="form-control" value="{{ $blog->publish_at }}">
                </div>
                <button type="submit" class="btn btn-primary" id="submit">Update blog</button>
                <p class=" text-right"></p>
        {!! Form::close() !!}
        <h3>Add Photos</h3>
        {!! Form::open(['route' => ['admin.add_photo_to_blog', $blog->id], 'class' => 'dropzone']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection
