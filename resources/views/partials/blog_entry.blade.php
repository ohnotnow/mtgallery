<h3>
    <a href="{!! route('blog.view', ['slug' => $blog->slug]) !!}">{{ $blog->title }}</a>
</h3>
<p class="publicblogbody">
    {!! $blog->getBody() !!}
</p>
<p class="text-right text-muted publicblogdate">
    Posted at {{ $blog->created_at->format('d/m/Y h:i') }}
</p>
@include('partials.blog_public_gallery')
<hr />