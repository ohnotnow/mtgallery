<html>
<head>
    <title>{!! env('APP_TITLE') !!}</title>
    <script src="{!! asset('jquery.js') !!}"></script>
    <script src="{!! asset('shine.min.js') !!}"></script>
    <link rel="stylesheet" href="{!! asset('monkeytwizzle.css') !!}">
    <link rel="stylesheet" href="{!! asset('lightbox2/dist/css/lightbox.css') !!}">
    <link rel="stylesheet" href="{!! asset('public.css') !!}">
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
</head>
<body>
    @yield('content')
</body>
<script src="{!! asset('lightbox2/dist/js/lightbox.min.js') !!}"></script>
<script>
$(document).ready(function() {
    var config = new shinejs.Config({
        numSteps: 7,
        opacity: 1,
        blur: 75,
        offset: 0.8,
        shadowRGB: new shinejs.Color(0, 0, 0)
    });
    var shine = new Shine(document.getElementById('title'), config);
    shine.light.position.x = window.innerWidth * 0.5;
    shine.light.position.y = window.innerHeight * 0.5;
    shine.draw();
    window.addEventListener('mousemove', function(event) {
        shine.light.position.x = event.clientX;
        shine.light.position.y = event.clientY;
        shine.draw();
    }, false);
    $('#aboutlink').click(function(e) {
        e.preventDefault();
        $('#contact').fadeOut({complete: function() {
            $('#about').fadeIn();
        }});
    });
    $('#contactlink').click(function(e) {
        e.preventDefault();
        $('#about').fadeOut({complete: function() {
            $('#contact').fadeIn();
        }});
    });
});
</script>
</html>
