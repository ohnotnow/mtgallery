<html>
<head>
    <title>
        {!! env('APP_TITLE') !!}
        {{ $pageTitle or '' }}
    </title>
    <link rel="stylesheet" href="{!! asset('slideshow.css') !!}">
</head>
<body>
<!--Thumbnail Navigation-->
    <div id="menu">
        <ul>
            <li><a href="{!! route('gallery.default') !!}">Recent</a></li>
            @foreach ($galleries as $gallery)
                <li><a href="{!! route('gallery.specific', $gallery->slug) !!}"> {{ $gallery->name }}</a></li>
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
            <a id="play-button"><img id="pauseplay" src="{!! asset('images/pause.png') !!}"/></a>
            <div id="slidecaption"></div>
            <a id="tray-button"><img id="tray-arrow" src="{!! asset('images/button-tray-up.png') !!}"/></a>
        </div>
    </div>
</body>
<script src="{!! asset('slideshow.js') !!}"></script>
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
