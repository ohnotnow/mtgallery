@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <h3>Index of All Photos</h3>
        {!! Form::open(['route' => ['admin.create_photo'], 'class' => 'dropzone']) !!}
        {!! Form::close() !!}

        <hr />
        @include('admin.partial_index_photographs')
    </div>
</div>
@endsection
