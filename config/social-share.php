<?php

return [
    'separator' => '&',
    'services' => [
        'facebook' => [
            'uri' => 'https://www.facebook.com/sharer/sharer.php', 
            'urlName' => 'u',
            'img' => '/assets/images/icon/ic_f.png'
        ],
        'google-plus' => [
            'uri' => 'https://plus.google.com/share', 
            'only' => [ 'url' ],
            'img' => '/assets/images/icon/ic_p.png'
        ],
        'twitter' => [
            'uri' => 'https://twitter.com/intent/tweet',
            'titleName' => 'text',
            'img' => '/assets/images/icon/ic_t.png'
        ],
            /*
        'vkontakte' => [
            'uri' => 'http://vk.com/share.php',
            // 'view' => 'share.partials.vkontakte',
            'mediaName' => 'image',
            'extra' => [
                'noparse' => 'false',
            ]
        ],*/
    ],
];
