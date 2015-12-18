@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <h3>
            Index of All Photos
            <a href="{!! route('admin.bulk_edit_photos') !!}" class="btn btn-default">Bulk Edit</a>
        </h3>
        {!! Form::open(['route' => ['admin.create_photo'], 'class' => 'dropzone']) !!}
        {!! Form::close() !!}

        <hr />
        @include('admin.partial_index_photographs')
    </div>
</div>
@endsection
