<?php $current_url = request()->fullUrl() ?>

    @foreach(Share::load($current_url, $item->present()->renderFullTitle(), $item->present()->renderCoverImage())->services() as $key => $social )
        <span>
            <a href="{{ Share::load($current_url, $item->present()->renderFullTitle(), $item->present()->renderCoverImage())->$key() }}"
               onclick="window.open(this.href,'targetWindow','menubar=no,scrollbars=yes,resizable=yes,width=660,height=600');return false;">
                <img src="/assets/images/icon/{{$key}}.png" alt="">
            </a>
        </span>
    @endforeach
