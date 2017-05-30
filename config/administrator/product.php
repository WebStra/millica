<?php

use App\Product;
use App\Category;
use App\Colection;

return [
    'title' => 'Product',
    'description' => 'product',
    'model' => Product::class,

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
        'title',
        'body' => [
            'title' => 'Descriere Produs',
            'output' => function ($row){
                return sprintf('%s ...', substr($row->body, 0, 75));
            }
        ],

        'active' => column_element('Active', false, function ($row) {
            return output_boolean($row);
        }),

        'dates' => [
            'elements' => [
                'created_at',
                'updated_at',
            ]
        ],
        'data' => [
            'title' => 'Config',
            'output' => function ($row) {
                return sprintf('%s', '<a href="/admin/pimage?id=' . $row->id . '"><span class="label label-success" style="font-size:14px;">Adauga continut</span></a>');
            }
        ],
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
        return $query->orderBy('id','DESC');
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

        'category_id' => form_select('Categoria', function () {
            $items = [];

            $collection = Category::select('*')->active()->get();

            foreach ($collection as $item) {
                $items[$item->id] = $item->title;
            }

            return $items;
        }),

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

        'category_id' => form_select('Categoria', function () {
            $items = [];

            $collection = Category::select('*')->active()->get();

            foreach ($collection as $item) {
                $items[$item->id] = $item->title;
            }

            return $items;
        }),

        'colection_id' => form_select('Colectia', function () {
            $items = [];

            $collection = Colection::select('*')->active()->get();
            $items[0] = 'Nu intra in colectie';
            foreach ($collection as $item) {
                $items[$item->id] = $item->title;
            }

            return $items;
        }),

        'quantity' => form_number('Cantitate'),

        'old_price' => form_number('Pretul Vechi'),

        'price' => form_number('Pretul'),

        'color'=>form_text() + translatable(),

        'title' => form_text() + translatable(),

        'body' => form_ckeditor() + translatable(),

        'delivery' => form_ckeditor() + translatable(),

        'active' => filter_select('Active', [
            1 => 'Yes',
            0 => 'No'
        ]),

    ]
];