<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\CategoryComposer;
use App\Http\ViewComposers\LanguageComposer;
use App\Http\ViewComposers\FiltersComposer;
use App\Http\ViewComposers\BasketComposer;
use App\Http\ViewComposers\FavoriteComposer;
use App\Http\ViewComposers\PagesComposer;

/**
 * Class ComposerServiceProvider
 * @package App\Providers
 */
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            '*', LanguageComposer::class
        );
        view()->composer('*', function ($view) {

            return $view->with('meta', (new \App\Meta));
        });

        view()->composer(
            '*', CategoryComposer::class
        );

        view()->composer(
            '*', FiltersComposer::class
        );
        view()->composer(
            '*', BasketComposer::class
        );
        view()->composer(
            '*', FavoriteComposer::class
        );

        view()->composer(
            '*', PagesComposer::class
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}