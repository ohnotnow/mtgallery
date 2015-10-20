<h3>
    <a href="/admin/blog/{{ $blog->id }}/edit">{{ $blog->title }}</a>
</h3>
<p>
    {{ $blog->body }}
</p>
<p class="text-right text-muted publicblogdate">
    Posted at {{ $blog->created_at->format('d/m/Y h:i') }}
</p>
@include('admin.partials.blog_gallery')
<hr />