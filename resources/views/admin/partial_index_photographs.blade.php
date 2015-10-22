        @foreach ($photos->chunk(6) as $set)
            <div class="row">
                @foreach ($set as $photo)
                    <div class="col-md-2">
                        <b>{{ $photo->name }}</b><br />
                        <ul class="list-inline">
                            @foreach ($photo->galleries as $gallery)
                                <li><a href="{!! route('admin.show_gallery', $gallery->id) !!}">{{ $gallery->name }}</a>,</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
            <div class="row">
                @foreach ($set as $photo)
                    <div class="col-md-2">
                        <a href="{!! route('admin.edit_photo', $photo->id) !!}" id="photo_{{ $photo->id }}">
                            <img src="{!! asset($photo->thumbnailPath()) !!}">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="row">&nbsp;</div>
        @endforeach
