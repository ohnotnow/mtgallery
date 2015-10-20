@extends('public_layout')
@section('content')
<div id="bloglanding">
    <a href="/">
    <h3 id="title">Monkeytwizzle Photography</h3>
    </a>
</div>
<div class="container-fluid">
    <div class="row publicblog">
        <h3>
            <a href="/blog">{{ $blog->title }}</a>
        </h3>
        <p>
            {{ $blog->body }}
        </p>
        <p class="text-right text-muted publicblogdate">
            Posted at {{ $blog->created_at->format('d/m/Y h:i') }}
        </p>
    </div>
    <div class="row publicblog">
        @include('partials.blog_public_gallery')
    </div>
</div>
@stop