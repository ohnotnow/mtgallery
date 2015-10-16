@if (count($blog->pictures) > 0)
    @foreach($blog->pictures as $photo)
        <a href="{!! asset($photo->imagePath()) !!}" data-lightbox="{{ $blog->slug }}"><img src="{!! asset($photo->thumbnailPath()) !!}" /></a>
    @endforeach
@endif