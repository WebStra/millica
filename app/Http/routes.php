<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Category;
use App\Product;
use App\Colection;
use App\Repositories\PagesRepository;

Route::bind('category', function ($id) {
    return ((new Category)->where('id', $id)->first());
});

Route::bind('colection', function ($id) {
    return ((new Colection())->where('id', $id)->first());
});

Route::bind('product', function ($id) {
    return ((new Product)->where('id', $id)->first());
});

Route::bind('static_page', function ($slug) {
    if ($static_page = (new PagesRepository())->find($slug))
        return $static_page;
    abort('404');
});

Route::multilingual(function () {

    Route::get('/', [
        'as' => 'home',
        'uses' => 'HomeController@home'
    ]);

    Route::get('contacts', [
        'as' => 'view_contacts',
        'uses' => 'ContactsController@index'
    ]);

    Route::post('send-contact', [
        'as' => 'send_contact_form',
        'uses' => 'ContactsController@requestData'
    ]);

    Route::get('blog', [
        'as' => 'blog_index',
        'uses' => 'PagesController@blogIndex'
    ]);

    Route::get('post/{id}/{title}', [
        'as' => 'blog_single',
        'uses' => 'PagesController@blogSingle'
    ]);

    Route::post('subscribe', [
        'as' => 'make_subscribe',
        'uses' => 'SubscribeController@subscribe'
    ]);

    Route::get('unuscribe/{token}', [
        'as' => 'make_unuscribe',
        'uses' => 'SubscribeController@unsuscribe'
    ]);

    Route::get('unuscribe/{token}', [
        'as' => 'make_unuscribe',
        'uses' => 'SubscribeController@unsuscribe'
    ]);


//---------Register Routes------- //

    Route::get('register', [
        'as' => 'get_register',
        'uses' => 'Auth\AuthController@getRegister'
    ]);

    Route::post('register', [
        'as' => 'post_register',
        'uses' => 'Auth\AuthController@postRegister'
    ]);

    Route::post('login', [
        'as' => 'post_login',
        'uses' => 'Auth\AuthController@postLogin'
    ]);
    Route::get('login', [
        'as' => 'get_login',
        'uses' => 'Auth\AuthController@getLogin'
    ]);
    Route::get('logout', [
        'as' => 'logout',
        'uses' => 'Auth\AuthController@logout'
    ]);


//---------Email Routes------- //

    Route::get('verified/{confirmationCode}', [
        'as' => 'verify_email',
        'uses' => 'Auth\VerifyController@confirm'
    ]);

//---------Category Routes------- //

    Route::get('category/{category}/{title}', [
        'as' => 'get_category',
        'uses' => 'ProductController@getByCategory'
    ]);

    //---------Collection Routes------- //

    Route::get('collection/{colection}/{title}', [
        'as' => 'get_colection',
        'uses' => 'ProductController@getByColection'
    ]);
//---------Product Routes------- //

    Route::get('products', [
        'as' => 'all_products',
        'uses' => 'ProductController@index'
    ]);

    Route::get('product-show/{product}/{title}', [
        'as' => 'show_product',
        'uses' => 'ProductController@singleProduct'
    ]);

    Route::post('send-filter/{category?}', [
        'as' => 'filter_product',
        'uses' => 'ProductController@filtres'
    ]);

    Route::post('filter-sale', [
        'as' => 'filter_sale',
        'uses' => 'ProductController@saleFilter'
    ]);

    //---------Favorites Routes------- //

    Route::get('favorite', [
        'as' => 'show_favorite',
        'uses' => 'ProductController@showFavorite'
    ]);

    Route::post('add-favorit', [
        'as' => 'add_to_favorite',
        'uses' => 'ProductController@addFavorite'
    ]);

    Route::get('on-sale', [
        'as' => 'get_sale_products',
        'uses' => 'ProductController@getSaleProducts'
    ]);

    Route::get('page/{static_page}', [
        'as' => 'show_page',
        'uses' => 'PagesController@showPage'
    ]);

    Route::get('about/{static_page}', [
        'as' => 'show_about',
        'uses' => 'PagesController@aboutPage'
    ]);

    //---------Basket Routes------- //

    Route::get('bascket', [
        'as' => 'view_basket',
        'uses' => 'BasketController@index'
    ]);

    Route::post('add-product/{product}', [
        'as' => 'add_to_baket',
        'uses' => 'BasketController@addProduct'
    ]);

    Route::get('delete-product-basket/{id}', [
        'as' => 'delete_product_basket',
        'uses' => 'BasketController@deleteProduct'
    ]);

    Route::post('update-product/basket', [
        'as' => 'update_product_basket',
        'uses' => 'BasketController@updateBasketProduct'
    ]);

    Route::get('ckeckout', [
        'as' => 'step_two',
        'uses' => 'BasketController@stepTwo'
    ]);

    Route::post('get_location', [
        'as' => 'get_location',
        'uses' => 'BasketController@getLocationByCity'
    ]);

    Route::post('next-step', [
        'as' => 'last_step',
        'uses' => 'BasketController@lastStep'
    ]);


    Route::get('command-sent/{nr}', [
        'as' => 'send_command',
        'uses' => 'BasketController@comandPlaced'
    ]);

    Route::get('courier-sent/{confirm_code}', [
        'as' => 'courier_comand',
        'uses' => 'BasketController@courierComand'
    ]);

    Route::post('check/promo', [
        'as' => 'check_promo_code',
        'uses' => 'BasketController@checkPromoCode'
    ]);

    //---------Search Routes------- //

    Route::get('search', [
        'as' => 'data_search',
        'uses' => 'SearchController@index'
    ]);


    // ------- Payment Routes ---------- //

    Route::get('payment', [
        'as' => 'payment',
        'uses' => 'PaymentController@index'
    ]);
    Route::post('paymentRedirect', [
        'as' => 'paymentRedirect',
        'uses' => 'PaymentController@paymentRedirect'
    ]);
    Route::post('paymentConfirm', [
        'as' => 'paymentConfirm',
        'uses' => 'PaymentController@paymentConfirm'
    ]);
    Route::get('paymentReturn', [
        'as' => 'paymentReturn',
        'uses' => 'PaymentController@paymentReturn'
    ]);


    Route::get('reset/password', [
       'as'=> 'reset_password' ,
        'uses' => 'Auth\PasswordController@restorePassGet'
    ]);


    Route::post('password/send-email',[
        'as' => 'send_email_password',
        'uses' => 'Auth\PasswordController@restorePassPost'
    ]);


    Route::get('password/reset/{confirmation_code?}', [
        'as' => 'new_password',
        'uses'=> 'Auth\PasswordController@resetPassword'
    ]);

    Route::post('change-password', [
        'as' => 'password_change',
        'uses'=> 'Auth\PasswordController@changePassword'
    ]);


    Route::group(['middleware' => 'auth'], function () {

        Route::get('profile-data', [
            'as' => 'change_profile',
            'uses' => 'SettingsController@profileData'
        ]);

        Route::get('comand', [
            'as' => 'comand_page',
            'uses' => 'SettingsController@commandUser'
        ]);

        Route::get('single-comand/{id}', [
            'as' => 'show_comand',
            'uses' => 'SettingsController@singleComand'
        ]);

        Route::get('cancel-comand/{id}', [
            'as' => 'cancel_comand',
            'uses' => 'SettingsController@cancelComand'
        ]);

        Route::get('change-password', [
            'as' => 'change_password',
            'uses' => 'SettingsController@profilePassword'
        ]);

        Route::post('update-profile', [
            'as' => 'update_profile',
            'uses' => 'SettingsController@updateProfile'
        ]);

        Route::post('update-password', [
            'as' => 'update_password',
            'uses' => 'SettingsController@updatePassword'
        ]);

        Route::get('resend-email', [
            'as' => 'resend_verify_token',
            'uses' => 'Auth\VerifyController@resendVerify'
        ]);

        Route::post('resend-email/resend', [
            'as' => 'resend_verify_email',
            'uses' => 'Auth\VerifyController@resendConfirmationCode'
        ]);

    });

});