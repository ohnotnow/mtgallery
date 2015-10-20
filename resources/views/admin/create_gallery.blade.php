@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        {!! Form::model($gallery, array('url' => '/admin/gallery/add')) !!}
                <div class="form-group">
                    <label for="name">Gallery Name</label>
                    <input type="text" name="name" class="form-control" id="">
                </div>
                <button type="submit" class="btn btn-primary" id="submit">Add new gallery</button>
            </form>
        {!! Form::close() !!}
    </div>
</div>
@endsection
