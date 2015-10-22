@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <a class="btn btn-primary" href="{!! route('admin.add_blog') !!}">Add Blog</a>
        <h3>List of Blog Entries</h3>
        @foreach ($blogs as $blog)
            @include('admin.partials.blog_entry')
        @endforeach
    </div>
</div>
@endsection
