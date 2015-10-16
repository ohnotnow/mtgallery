@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <h3>Edit Photo {{ $photo->name }}</h3>
        {!! Form::model($photo, array('url' => '/admin/photo/' . $photo->id . '/edit')) !!}
                <div class="form-group">
                    <label for="name">Photo Name</label>
                    {!! Form::text('name', $photo->name, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="galleries[]">Galleries</label>
                    <select name="galleries[]" class="form-control" id="gallery_select" multiple>
                    @foreach ($galleries as $gallery)
                        <option value="{{ $gallery->id }}" @if (in_array($gallery->id, $photo->galleryList())) selected="selected" @endif>
                            {{ $gallery->name }}
                        </option>
                    @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" id="submit">Save Changes</button>
        {!! Form::close() !!}
        <hr />
        <img src="{!! asset('mt_photos/' . $photo->filename) !!}" />
        <hr />
        {!! Form::open(array('url' => '/admin/photo/' . $photo->id, 'method' => 'DELETE')) !!}
            <button type="submit" class="btn btn-danger" id="delete">Delete Photograph</button>
        {!! Form::close() !!}
        <hr />
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#gallery_select').select2();
    });
</script>
@endsection
