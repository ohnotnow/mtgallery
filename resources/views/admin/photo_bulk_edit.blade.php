@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <h3>Bulk Edit Photographs</h3>
        <hr />
        {!! Form::open(['route' => 'admin.bulk_update_photos']) !!}
        @foreach ($photos->chunk(4) as $set)
            <div class="row">
                @foreach ($set as $photo)
                    <div class="col-md-3">
                        <img src="{!! asset($photo->thumbnailPath()) !!}">
                    </div>
                @endforeach
            </div>
            <div class="row">
                @foreach ($set as $photo)
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input type="text" id="inputName" name="name[{{ $photo->id }}]" value="{{ $photo->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="galleries[{{ $photo->id }}][]">Galleries</label>
                            <select name="galleries[{{ $photo->id }}][]" class="form-control gallery_select" multiple>
                            @foreach ($galleries as $gallery)
                                <option value="{{ $gallery->id }}" @if (in_array($gallery->id, $photo->galleryList())) selected="selected" @endif>
                                    {{ $gallery->name }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Update</button>
        {!! Form::close() !!}
        <p />
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        $('.gallery_select').select2();
    });
</script>
@endsection
