<?php

return [
    'title' => 'Site',

    'model' => 'Keyhunter\Administrator\Model\Settings',

    'edit_fields' => [

        'contact::adress' => ['type' => 'text'],

        'contact::phone' => ['type' => 'text'],

        'contact::email' => ['type' => 'email'],

        'contact::orar' => ['type' => 'text'],

        'contact::facebook' => ['type' => 'text'],

        'contact::twitter' => ['type' => 'text'],

        'contact::instagram' => ['type' => 'text'],

        'contact::pinterest' => ['type' => 'text'],

        'site::down' => [
            'type' => 'select',
            'options' => [
                1 => 'enable',
                0 => 'disable'
            ]
        ]
    ]
];