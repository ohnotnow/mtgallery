<html>
<head>
    <title>
        {!! env('APP_TITLE') !!}
        {{ $pageTitle or '' }}
    </title>
    <script src="{!! asset('jquery.js') !!}"></script>
    <script src="{!! asset('supersized/slideshow/js/supersized.3.2.7.min.js') !!}"></script>
    <script src="{!! asset('supersized/slideshow/theme/supersized.shutter.min.js') !!}"></script>
    <script type="text/javascript" src="jquery.easing.min.js"></script>
    <link rel="stylesheet" href="{!! asset('supersized/slideshow/css/supersized.css') !!}">
    <link rel="stylesheet" href="{!! asset('supersized/slideshow/theme/supersized.shutter.css') !!}">
    <link rel="stylesheet" href="{!! asset('monkeytwizzle.css') !!}">
</head>
<body>
<!--Thumbnail Navigation-->
    <div id="menu">
        Galleries
        <ul>
            <li><a href="/gallery"> Recent</a></li>
            @foreach ($galleries as $gallery)
                <li><a href="/gallery/{{ $gallery->slug }}"> {{ $gallery->name }}</a></li>
            @endforeach
        </ul>
    </div>

    <div id="prevthumb"></div>
    <div id="nextthumb"></div>
    <!--Arrow Navigation-->
    <a id="prevslide" class="load-item"></a>
    <a id="nextslide" class="load-item"></a>
    <div id="thumb-tray" class="load-item">
        <div id="thumb-back"></div>
        <div id="thumb-forward"></div>
    </div>
    <div id="controls-wrapper" class="load-item">
        <div id="controls">
            <a id="play-button"><img id="pauseplay" src="{!! asset('supersized/slideshow/img/pause.png') !!}"/></a>
            <div id="slidecaption"></div>
            <a id="tray-button"><img id="tray-arrow" src="{!! asset('supersized/slideshow/img/button-tray-up.png') !!}"/></a>
        </div>
    </div>
</body>
<script type="text/javascript">
            jQuery(function($){
                $.supersized({
                    slide_interval          :   3000,
                    transition              :   1,
                    transition_speed        :   700,
                    slide_links             :   'blank',
                    slides                  :   {!! $json !!}
                });

                var timer;

                if($('#menu').is(":visible")){
                    timer = setTimeout(function() {
                        $('#menu').fadeOut();
                    }, 2000);
                }
                $(document).bind("mousemove", function(e) {
                    clearTimeout(timer);
                    $('#menu').fadeIn();
                    timer = setTimeout(function() {
                        $('#menu').fadeOut();
                    }, 2000);
                });
            });
        </script>
</html>
