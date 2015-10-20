@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
            <h3>Blog <a href="/admin/blog/{{ $blog->id }}/edit">{{ $blog->title }}</a></h3>
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
