<?php
namespace App\Repositories;

use App\Product;

/**
 * Class ProductRepository
 * @package App\Repositories
 */
class ProductRepository extends Repository
{

    /**
     * @return Product
     */
    public function getModel()
    {
        return new Product();
    }

    /**
     * @return mixed
     */
    public function getPublic()
    {
        return self::getModel()
            ->active()
            ->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return self::getModel()
            ->where('id', $id)
            ->first();
    }

    /**
     * @param int $perPage
     * @return mixed
     */
    public function getProducts($perPage = 20)
    {
        return self::getModel()
            ->active()
            ->orderBy('id','DESC')
            ->paginate($perPage);
    }

    /**
     * @return mixed
     */
    public function countProduct()
    {
        return self::getModel()
            ->active()
            ->count();
    }

    /**
     * @return mixed
     */
    public function countSaleProduct()
    {
        return self::getModel()
            ->active()
            ->where('old_price', '!=', 0)
            ->count();
    }

    /**
     * @param int $items
     * @return mixed
     */
    public function getHomeProducts($items = 15)
    {
        return self::getModel()
            ->active()
            ->take($items)
            ->get();
    }

    /**
     * @param int $items
     * @return mixed
     */
    public function getHomeSales($items = 15)
    {
        return self::getModel()
            ->active()
            ->where('old_price', '!=', 0)
            ->take($items)
            ->get();
    }

    /**
     * @return mixed
     */
    public function getSaleProduct($items)
    {
        return self::getModel()
            ->active()
            ->where('old_price', '!=', 0)
            ->orderBy('id','DESC')
            ->paginate($items);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getByCategory($id)
    {
        return self::getModel()
            ->where('category_id', $id)
            ->take(15)
            ->get();
    }

    /**
     * @return mixed
     */
    public function getByCategoryAdmin($id)
    {
        return self::getModel()
            ->where('category_id', $id)
            ->get();
    }

}