<?php
namespace App\Http\ViewComposers;

use App\Repositories\BasketRepository;
use Illuminate\Contracts\View\View;
use Auth;

/**
 * Class BasketComposer
 * @package App\Http\ViewComposers
 */
class BasketComposer extends Composer
{

    /**
     * @var BasketRepository
     */
    protected $basket;


    /**
     * BasketComposer constructor.
     * @param BasketRepository $basketRepository
     */
    public function __construct(BasketRepository $basketRepository)
    {
        $this->basket = $basketRepository;
    }

    /**
     * @param View $view
     * @return $this
     */
    public function compose(View $view)
    {
        $countProduct = count($this->basket->getByUserPublic());

        return $view->with('itemInBasket', $countProduct);
    }
}