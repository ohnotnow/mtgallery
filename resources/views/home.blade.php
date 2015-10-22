@extends('public_layout')
@section('content')
<div id="landing">
    <h3 id="title">Monkeytwizzle Photography</h3>
    <a id="link1" href="{!! route('gallery.default') !!}">Photographs</a> |
    <a id="link2" href="{!! route('blog') !!}">Blog</a> |
    <a id="aboutlink" href="#">About</a> |
    <a id="contactlink" href="#">Contact</a>
</div>
<div id="about" class="blurb" style="display:none">
    <p>
        I am a Glasgow based photographer working in both digital and analogue media. Though increasingly leaning towards purely film.
    </p>
    <p>
        I originally worked in paint and moved to photography in about 2007. My influences come from a variety of sources - mostly painting and old film. To name-check a few I guess Francis Bacon, Edvard Munch, de Chirico, Paula Rego, Caravaggio, Robert Wiene, F. W. Murnau, Hitchcock, David Lynch.
    </p>
    <p>
        I've been published in print and exhibited numerous times - though I try and avoid it if I can.
    </p>
</div>
<div id="contact" class="blurb" style="display:none">
    <p>
        Please just email "photography at monkeytwizzle.com" to get in touch.
    </p>
</div>
@stop

