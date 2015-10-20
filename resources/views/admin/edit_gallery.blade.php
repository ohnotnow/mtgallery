@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <h3>Edit Gallery <a href="/admin/gallery/{{ $gallery->id }}">{{ $gallery->name }}</a></h3>
        {!! Form::model($gallery, array('url' => '/admin/gallery/' . $gallery->id . '/edit')) !!}
                <div class="form-group">
                    <label for="name">Gallery Name</label>
                    <input type="text" name="name" class="form-control" id="" value="{{ $gallery->name }}">
                </div>
                <button type="submit" class="btn btn-primary" id="submit">Save Changes</button>
            </form>
        {!! Form::close() !!}
        {!! Form::open(array('url' => '/admin/gallery/' . $gallery->id, 'method' => 'DELETE', 'class' => 'text-right')) !!}
                <button type="submit" class="btn btn-danger text-right" id="delete">Delete Gallery</button>
        {!! Form::close() !!}
    </div>
</div>
@endsection
