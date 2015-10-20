@if (count($blog->pictures) > 0)
    @foreach($blog->pictures->chunk(4) as $set)
        <div class="row">
        @foreach($set as $photo)
            <div class="col-md-3">
                <a href="{!! route('admin.delete_photo_from_blog', ['id' => $blog->id, 'photo_id' => $photo->id]) !!}" id="delete_photo_{{ $photo->id }}" class="deleteblogphoto">
                    <img src="{!! asset($photo->thumbnailPath()) !!}" />
                </a>
            </div>
        @endforeach
        </div>
    @endforeach
@endif