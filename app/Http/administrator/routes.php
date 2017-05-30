<?php
use App\Repositories\ProductRepository;
use App\PromoCode;
use App\UsedCodes;

// Use 'web' middleware if you using laravel version since 5.2

Route::bind('product', function ($id) {
    if ($product = (new ProductRepository())->find($id))
        return $product;
    abort('404');
});

Route::bind('promoCode', function ($id) {
    if ($promo = (new PromoCode())->find($id))
        return $promo;
    abort('404');
});

Route::bind('usedCodes', function ($id) {
    if ($used = (new UsedCodes())->find($id))
        return $used;
    abort('404');
});

Route::group(['prefix' => 'admin', 'middleware' => 'web'], function () {
    /*
    |-------------------------------------------------------
    | Authentication
    |-------------------------------------------------------
    */
    Route::get('login', 'Keyhunter\Administrator\AuthController@getLogin');
    Route::post('login', 'Keyhunter\Administrator\AuthController@postLogin');
    Route::get('logout', 'Keyhunter\Administrator\AuthController@logout');
});

Route::group(['prefix' => 'admin'
    , 'middleware' => ['web', '\Keyhunter\Administrator\Middleware\Authenticate']
], function () {
    Route::get('/', function () {
        $homepage = config('administrator.home_page', '/members');

        return \Redirect::to($homepage);
    });

    /*
    |-------------------------------------------------------
    | Settings
    |-------------------------------------------------------
    */
    Route::group(['middleware' => '\Keyhunter\Administrator\Middleware\Settings'], function () {
        Route::get('settings/{page}',
            [
                'as' => 'admin_settings_edit',
                'uses' => 'Keyhunter\Administrator\Controller@listSettings'
            ]);

        Route::post('settings/{page}',
            [
                'as' => 'admin_settings_update',
                'uses' => 'Keyhunter\Administrator\Controller@saveSettings'
            ]);
    });

    /*
    |-------------------------------------------------------
    | Main Scaffolding routes
    |-------------------------------------------------------
    */
    Route::group(['middleware' => '\Keyhunter\Administrator\Middleware\Module'], function () {
        /*
        |-------------------------------------------------------
        | Custom routes
        |-------------------------------------------------------
        |
        | Controllers that shouldn't be handled by Scaffolding controller
        | goes here.
        |
        */
//        Route::controllers([
//            'test' => 'App\Http\Controllers\Admin\TestController'
//        ]);


        /*
        |-------------------------------------------------------
        | Scaffolding routes
        |-------------------------------------------------------
        */
        // Dashboard
        Route::get('dashboard', [
            'as' => 'admin_dashboard',
            'uses' => 'App\Http\administrator\DashboardStatisticController@dashboard'
        ]);

        Route::get('promo', [
            'as' => 'promo_code',
            'uses' => 'App\Http\administrator\DashboardStatisticController@promoCode'
        ]);

        Route::get('command/{id}', [
            'as' => 'admin_comand',
            'uses' => 'App\Http\administrator\DashboardStatisticController@singleComand'
        ]);

        Route::get('delete/promo/{promoCode}', [
            'as' => 'delete_promo_code',
            'uses' => 'App\Http\administrator\DashboardStatisticController@deletePromoCode'
        ]);

        Route::get('delete_used_codes/{usedCodes}', [
            'as' => 'delete_used_codes',
            'uses' => 'App\Http\administrator\DashboardStatisticController@deleteUsedCodes'
        ]);

        Route::get('delete-command/{code}', [
            'as' => 'delete_comand',
            'uses' => 'App\Http\administrator\DashboardStatisticController@deleteComand'
        ]);

        Route::post('generate-awb', [
            'as' => 'generate_awb',
            'uses' => 'App\Http\administrator\DashboardStatisticController@generateAwb'
        ]);

        Route::post('create_promo', [
            'as' => 'create_promo_code',
            'uses' => 'App\Http\administrator\DashboardStatisticController@createPromoCode'
        ]);

        Route::post('order-courier', [
            'as' => 'order_courier',
            'uses' => 'App\Http\administrator\DashboardStatisticController@orderCourier'
        ]);


        // Product Controller

        Route::get('pimage/{id?}', [
            'as' => 'update_prod',
            'uses' => 'App\Http\administrator\ProductController@index'
        ]);
        Route::post('upload/{id}', [
            'as' => 'upload-post',
            'uses' => 'App\Http\administrator\ProductController@postUpload'
        ]);

        Route::post('delete/image', [
            'as' => 'upload_remove',
            'uses' => 'App\Http\administrator\ProductController@deleteUpload'
        ]);

        Route::get('server-images/{id?}', [
            'as' => 'prod_images',
            'uses' => 'App\Http\administrator\ProductController@getProductImage'
        ]);

        Route::post('add-sizes', [
            'as' => 'add_sizes',
            'uses' => 'App\Http\administrator\ProductController@addSizes'
        ]);

        Route::post('update-sizes', [
            'as' => 'update_size',
            'uses' => 'App\Http\administrator\ProductController@updateSize'
        ]);

        Route::get('deletesizes/{id}', [
            'as' => 'delete_sizes',
            'uses' => 'App\Http\administrator\ProductController@deleteSizes'
        ]);

        Route::get('deletesame/{id}', [
            'as' => 'delete_same',
            'uses' => 'App\Http\administrator\ProductController@deleteSame'
        ]);

        Route::post('add-same-product', [
            'as' => 'add_same_prod',
            'uses' => 'App\Http\administrator\ProductController@addSame'
        ]);
        //-------------Filter Route------------------//

        Route::post('filter/{id}', [
            'as' => 'add_filter',
            'uses' => 'App\Http\administrator\ProductController@addFilter'
        ]);

        Route::post('delete-filter/{id}', [
            'as' => 'delete_filter',
            'uses' => 'App\Http\administrator\ProductController@deleteFilter'
        ]);

        //-------------End--Filter Route------------------//


        // Index
        Route::get('{page}',
            [
                'as' => 'admin_model_index',
                'uses' => 'Keyhunter\Administrator\Controller@index'
            ]);

        // Create new Item
        Route::get('{page}/create',
            [
                'as' => 'admin_model_create',
                'uses' => 'Keyhunter\Administrator\Controller@create'
            ]);

        // Save new item
        Route::post('{page}/create', 'Keyhunter\Administrator\Controller@update');

        // View Item
        Route::get('{page}/{id}',
            [
                'as' => 'admin_model_view',
                'uses' => 'Keyhunter\Administrator\Controller@view'
            ]);

        // Edit Item
        Route::get('{page}/{id?}/edit',
            [
                'as' => 'admin_model_edit',
                'uses' => 'Keyhunter\Administrator\Controller@edit'
            ]);

        // Save Item
        Route::post('{page}/{id?}/edit',
            [
                'as' => 'admin_model_save',
                'uses' => 'Keyhunter\Administrator\Controller@update'
            ]);

        // Delete Item
        Route::get('{page}/{id}/delete',
            [
                'as' => 'admin_model_delete',
                'uses' => 'Keyhunter\Administrator\Controller@delete'
            ]);

        // Custom Item Action
        Route::get('{page}/{id}/do-{action}',
            [
                'as' => 'admin_model_custom_action',
                'uses' => 'Keyhunter\Administrator\Controller@custom'
            ]);

        // Custom Global Action
        Route::post('{page}/do-custom',
            [
                'as' => 'admin_model_global_action',
                'uses' => 'Keyhunter\Administrator\Controller@customGlobal'
            ]);
    });
});