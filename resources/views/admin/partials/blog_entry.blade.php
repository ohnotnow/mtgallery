<h3>
    <a href="{!! route('admin.edit_blog', $blog->id) !!}">{{ $blog->title }}</a>
</h3>
<p>
    {!! $blog->getBody() !!}
</p>
<p class="text-right text-muted publicblogdate">
    Posted at {{ $blog->created_at->format('d/m/Y h:i') }}
</p>
@include('admin.partials.blog_gallery')
<hr />