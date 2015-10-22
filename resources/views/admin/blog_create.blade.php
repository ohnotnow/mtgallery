@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <h3>New Blog</h3>
        {!! Form::model($blog, array('route' => 'admin.create_blog')) !!}
                <div class="form-group">
                    <label for="name">Blog Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Blog</label>
                    <textarea name="body" class="form-control" rows="10"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" id="submit">Add blog</button>
            </form>
        {!! Form::close() !!}
    </div>
</div>
@endsection
