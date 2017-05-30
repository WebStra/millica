<?php
namespace App\Repositories;

use App\Favorite;

/**
 * Class FavoriteRepository
 * @package App\Repositories
 */
class FavoriteRepository extends Repository
{
    /**
     * @return Favorite
     */
    public function getModel()
    {
        return new Favorite();
    }

    /**
     * @param $product
     * @return static
     */
    public function addProduct($product)
    {
        return self::getModel()
            ->create([
                'product_id' => $product,
                'user_id' => (\Auth::user()) ? \Auth::user()->id : '',
                'user_ip' => \Request::ip(),
                'active' => 1
            ]);
    }

    /**
     * @param $product
     * @return mixed
     */
    public function getById($product)
    {
        if (\Auth::user()) {
            return self::getModel()
                ->where('user_id', \Auth::user()->id)
                ->where('product_id', $product)
                ->first();
        } else {
            return self::getModel()
                ->where('user_ip', \Request::ip())
                ->where('product_id', $product)
                ->first();
        }
    }

    /**
     * @return mixed
     */
    public function getByIp()
    {
        return self::getModel()
            ->where('user_ip', \Request::ip())
            ->get();
    }

    /**
     * @param int $paginate
     * @return mixed
     */
    public function getUserFavorites($paginate = 15)
    {
        if (\Auth::user()) {
            return self::getModel()
                ->where('user_id', \Auth::user()->id)
                ->paginate();
        } else {
            return self::getModel()
                ->where('user_ip', \Request::ip())
                ->paginate();
        }
    }

}