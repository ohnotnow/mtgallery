@if (count($blog->pictures) > 0)
    @foreach($blog->pictures->chunk(4) as $set)
        <div class="row">
        @foreach($set as $photo)
            <div class="col-md-3">
                <a href="/admin/blog/{{ $blog->id }}/deletephoto/{{ $photo->id }}" id="delete_photo_{{ $photo->id }}" class="deleteblogphoto">
                    <img src="{!! asset($photo->thumbnailPath()) !!}" />
                </a>
            </div>
        @endforeach
        </div>
    @endforeach
@endif