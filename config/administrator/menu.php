<?php

/**
 * The menu structure of the site. For models, you should either supply the name of a model config file or an array of names of model config
 * files. The same applies to settings config files, except you must prepend 'settings.' to the settings config file name. You can also add
 * custom pages by prepending a view path with 'page.'. By providing an array of names, you can group certain models or settings pages
 * together. Each name needs to either have a config file in your model config path, settings config path with the same name, or a path to a
 * fully-qualified Laravel view. So 'users' would require a 'users.php' file in your model config path, 'settings.site' would require a
 * 'site.php' file in your settings config path, and 'page.foo.test' would require a 'test.php' or 'test.blade.php' file in a 'foo' directory
 * inside your view directory.
 *
 * @type array
 *
 *    array(
 *        'E-Commerce' => array('collections', 'products', 'product_images', 'orders'),
 *        'homepage_sliders',
 *        'users',
 *        'roles',
 *        'colors',
 *        'Settings' => array('settings.site', 'settings.ecommerce', 'settings.social'),
 *        'Analytics' => array('E-Commerce' => 'page.ecommerce.analytics'),
 *    )
 */
return [
    'dashboard' => [
        'icon' => 'fa-dashboard',
    ],
    'Roles' => [
        'page_header' => 'Administraators and users',
        'pages' => [
            'admins' => [
                'icon' => 'fa fa-user'
            ],
            'members' => [
                'icon' => 'fa fa-users'
            ]
        ]
    ],

    'Add Filtres' => [
        'page_header' => 'Filters',
        'pages' => [
            'sizes' => [
                'icon' => 'fa fa-cog'
            ],
            'colors' => [
                'icon' => 'fa fa-cog'
            ],
            'seasons' => [
                'icon' => 'fa fa-cog'
            ],
            'aditional' => [
                'icon' => 'fa fa-cog'
            ],
        ]
    ],

    'Add Product' => [
        'page_header' => 'product content',
        'pages' => [
            'category' => [
                'icon' => 'fa fa-sitemap'
            ],
            'colection' => [
                'icon' => 'fa fa-cloud'
            ],
            'product' => [
                'icon' => 'fa fa-shopping-bag'
            ],
        ]
    ],

    'promo' => [
        'icon' => 'fa fa-diamond'
    ],

    'pages' => [
        'icon' => 'fa fa-file-word-o'
    ],


    'slide' => [
        'icon' => 'fa fa-picture-o'
    ],

    'blog' => [
        'icon' => 'fa fa-newspaper-o'
    ],

    'meta' => [
        'icon' => 'fa fa-file-text-o'
    ],

    'contacts' => [
        'icon' => 'fa fa-envelope-o'
    ],

    'subscribe' => [
        'icon' => 'fa fa-child'
    ],

];
