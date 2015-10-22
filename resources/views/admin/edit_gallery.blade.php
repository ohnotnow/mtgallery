@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <h3>Edit Gallery <a href="{!! route('admin.show_gallery', $gallery->id) !!}">{{ $gallery->name }}</a></h3>
        {!! Form::model($gallery, ['route' => ['admin.update_gallery', $gallery->id]]) !!}
                <div class="form-group">
                    <label for="name">Gallery Name</label>
                    <input type="text" name="name" class="form-control" id="" value="{{ $gallery->name }}">
                </div>
                <button type="submit" class="btn btn-primary" id="submit">Save Changes</button>
            </form>
        {!! Form::close() !!}
        {!! Form::open(['route' => ['admin.delete_gallery', $gallery->id], 'method' => 'DELETE', 'class' => 'text-right']) !!}
                <button type="submit" class="btn btn-danger text-right" id="delete">Delete Gallery</button>
        {!! Form::close() !!}
    </div>
</div>
@endsection
