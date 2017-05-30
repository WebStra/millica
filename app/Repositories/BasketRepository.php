<?php
namespace App\Repositories;

use App\Basket;
use Auth;

/**
 * Class BasketRepository
 * @package App\Repositories
 */
class BasketRepository extends Repository
{

    /**
     * @return Basket
     */
    public function getModel()
    {
        return new Basket();
    }

    /**
     * @return mixed
     */
    public function getPublic()
    {
        return self::getModel()
            ->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getSingle($id)
    {
        return self::getModel()
            ->whereId($id)
            ->first();
    }

    /**
     * @return mixed
     */
    public function getByUser($paginate = 10)
    {
        if (\Auth::user()) {
            return self::getModel()
                ->where('user_id', \Auth::user()->id)
                ->paginate($paginate);
        } else {
            return self::getModel()
                ->where('user_ip', \Request::ip())
                ->paginate($paginate);
        }
    }

    /**
     * @return mixed
     */
    public function getByUserPublic()
    {
        if (\Auth::user()) {
            return self::getModel()
                ->where('user_id', \Auth::user()->id)
                ->get();
        } else {
            return self::getModel()
                ->where('user_ip', \Request::ip())
                ->get();
        }
    }

    public function getByIpPublic()
    {
        return self::getModel()
            ->where('user_ip', \Request::ip())
            ->get();
    }

    /**
     * @return mixed
     */
    public function sumProductPrice()
    {
        if (\Auth::user()) {
            return self::getModel()
                ->where('user_id', \Auth::user()->id)
                ->sum('price');
        } else {
            return self::getModel()
                ->where('user_ip', \Request::ip())
                ->sum('price');
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        if (\Auth::user()) {
            return self::getModel()
                ->where('id', $id)
                ->where('user_id', \Auth::user()->id)
                ->first();
        } else {
            return self::getModel()
                ->where('id', $id)
                ->where('user_ip', \Request::ip())
                ->first();
        }
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getByCategoryId($id)
    {
        if (\Auth::user()) {
            return self::getModel()
                ->where('user_id', \Auth::user()->id)
                ->where('category_id', $id)
                ->first();
        } else {
            return self::getModel()
                ->where('user_id', \Request::ip())
                ->where('category_id', $id)
                ->first();
        }
    }


    /**
     * @param $request
     * @param $product
     * @param $getPrice
     * @return mixed
     */
    public function addProduct($request, $product, $getPrice, $promo)
    {
        return self::getModel()
            ->firstOrCreate([
                'product_id' => $product->id,
                'user_id' => (\Auth::user()) ? \Auth::user()->id : '',
                'user_ip' => \Request::ip(),
                'quantity' => $request['quantity'],
                'color' => $request['color'],
                'size' => $request['size'],
                'category_id' => $product->category_id,
                'price' => $getPrice,
                'promo_code' => $promo
            ]);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function updateCommand($request, $price)
    {
        return self::getModel()
            ->whereId($request['item'])
            ->update([
                'quantity' => $request['count'],
                'size' => $request['sizes'],
                'price' => $price
            ]);
    }
}