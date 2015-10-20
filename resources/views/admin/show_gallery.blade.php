@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <h3>Photographs in <a href="{!! route('admin.edit_gallery', ['id' => $gallery->id]) !!}">{{ $gallery->name }}</a></h3>
        @include('admin.partial_index_photographs', ['photos' => $gallery->photos])
    </div>
</div>
@endsection
