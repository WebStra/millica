<?php
namespace App\Repositories;

use App\ProductComand;

/**
 * Class ProductComandRepository
 * @package App\Repositories
 */
class ProductComandRepository extends Repository
{

    /**
     * @return ProductComand
     */
    public function getModel()
    {
        return new ProductComand();
    }


    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function addProduct($request, $id)
    {
        return self::getModel()
            ->firstOrCreate([
                'product_id' => $request->product_id,
                'comand_id' => $id,
                'user_id' => \Auth::user()->id,
                'quantity' => $request->quantity,
                'size' => $request->size,
                'price' => $request->price,
                'promo_code' => $request->promo_code,
                'active' => 1
            ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getByComandId($id)
    {
        return self::getModel()
            ->where('comand_id', $id)
            ->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function sumProductPrice($id){
        return self::getModel()
            ->active()
            ->where('comand_id', $id)
            ->sum('price');
    }


}