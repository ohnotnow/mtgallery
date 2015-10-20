@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
            <h3>Blog <a href="{!! route('admin.edit_blog', ['id' => $blog->id]) !!}">{{ $blog->title }}</a></h3>
            <div class="blog_body">
                {{ $blog->body }}
            </div>
    </div>
    <div class="row">
        @include('admin.partials.blog_gallery')
    </div>
</div>
<script src="{!! asset('dropzone.js') !!}"></script>
@endsection
