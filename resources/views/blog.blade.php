@extends('public_layout')
@section('content')
<div id="landing">
    <a href="/">
        <h3 id="title">Monkeytwizzle Photography</h3>
    </a>
</div>
<div class="container-fluid">
    <div class="row publicblog">
        @foreach ($blogs as $blog)
            @include('partials.blog_entry')
        @endforeach
    </div>
</div>
@stop
