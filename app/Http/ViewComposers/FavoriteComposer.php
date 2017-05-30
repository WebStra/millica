<?php
namespace App\Http\ViewComposers;

use App\Repositories\FavoriteRepository;
use Illuminate\Contracts\View\View;

/**
 * Class CategoryComposer
 * @package App\Http\ViewComposers
 */
class FavoriteComposer extends Composer
{
    /**
     * @var FavoriteRepository
     */
    protected $favorit;

    /**
     * FavoriteComposer constructor.
     * @param FavoriteRepository $favoriteRepository
     */
    public function __construct(FavoriteRepository $favoriteRepository)
    {
        $this->favorit = $favoriteRepository;
    }

    /**
     * @param View $view
     * @return $this
     */
    public function compose(View $view)
    {
        $isFavorit = $this->favorit;
        $countFavoriteProducts = count($this->favorit->getUserFavorites());

        return $view->with(['isFavorite' => $isFavorit, 'countFavoriteProducts' => $countFavoriteProducts]);
    }
}