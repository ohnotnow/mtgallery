@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <a class="btn btn-primary" href="/admin/gallery/add">Add Gallery</a>
        <h3>Current Galleries</h3>
        <table class="table table-striped">
            <tr>
                <th>Gallery Name</th>
                <th>Number of photos</th>
            </tr>
            @foreach ($galleries as $gallery)
                <tr>
                    <td><a href="/admin/gallery/{{ $gallery->id }}">{{ $gallery->name }}</a></td>
                    <td>{{ count($gallery->photos) }}</td>
                </tr>
            @endforeach
    </div>
</div>
@endsection
