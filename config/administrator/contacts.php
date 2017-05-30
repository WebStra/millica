<?php

use App\Contacts;

return [
    'title' => 'Mesaje Support',

    'description' => 'Support',

    'model' => Contacts::class,

    /*
    |-------------------------------------------------------
    | Columns/Groups
    |-------------------------------------------------------
    |
    | Describe here full list of columns that should be presented
    | on main listing page
    |
    */
    'columns' => [
        'id',

        'email',

        'phone',

        'subject',

        'active' => column_element('Active', false, function ($row) {
            return output_boolean($row);
        }),

        'dates' => [
            'elements' => [
                'created_at',
                'updated_at',
            ]
        ]
    ],

    /*
    |-------------------------------------------------------
    | Actions available to do, including global
    |-------------------------------------------------------
    |
    | Global actions
    |
    */
    'actions' => [

    ],

    /*
    |-------------------------------------------------------
    | Eloquent With Section
    |-------------------------------------------------------
    |
    | Eloquent lazy data loading, just list relations that should be preloaded
    |
    */
    'with' => [

    ],

    /*
    |-------------------------------------------------------
    | QueryBuilder
    |-------------------------------------------------------
    |
    | Extend the main scaffold index query
    |
    */
    'query' => function ($query) {
        return $query;
    },

    /*
    |-------------------------------------------------------
    | Global filter
    |-------------------------------------------------------
    |
    | Filters should be defined here
    |
    */
    'filters' => [

        'active' => filter_select('Active', [
            '' => '-- Any --',
            0 => 'No',
            1 => 'Yes'
        ]),

        'created_at' => filter_daterange('Created period')

    ],

    /*
    |-------------------------------------------------------
    | Editable area
    |-------------------------------------------------------
    |
    | Describe here all fields that should be editable
    |
    */
    'edit_fields' => [

        'id' => form_key(),

        'title' => form_text(),

        'phone' => form_text(),

        'email' => form_text(),

        'subject' => form_ckeditor(),

        'active' => filter_select('Active', [
            1 => 'Yes',
            0 => 'No'
        ]),

    ]
];