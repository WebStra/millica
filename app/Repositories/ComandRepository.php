<?php
namespace App\Repositories;

use App\Comand;

/**
 * Class ComandRepository
 * @package App\Repositories
 */
class ComandRepository extends Repository
{

    /**
     * @return Comand
     */
    public function getModel()
    {
        return new Comand();
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
     * @return mixed
     */
    public function createEmptyComand()
    {
        $query = self::getModel()
            ->create([
                'user' => \Auth::user()->id,
                'confirm_code' => str_random(30)
            ]);

        return $query->confirm_code;
    }

    /**
     * @param $request
     * @param $paid
     * @param $price
     * @return mixed
     */
    public function updateEmptyComand($request, $paid, $price)
    {
        return self::getModel()
            ->where('confirm_code', $request['key'])
            ->update([
                'user' => \Auth::user()->id,
                'delname' => $request['deliveryname'],
                'delphone' => $request['deliveryphone'],
                'deladress' => $request['deliveryadress'],
                'deljudet' => $request['deliveryjudet'],
                'dellocation' => $request['deliveryjlocation'],
                'facname' => $request['facturarename'],
                'facphone' => $request['facturarephone'],
                'facadress' => $request['facturareadress'],
                'facjudet' => $request['facturarejudet'],
                'faclocation' => $request['facturarelocation'],
                'payment' => $request['paymentMethod'],
                'contname' => $request['contname'],
                'contphone' => $request['contphone'],
                'cnp' => $request['cnp'],
                'payment_status' => $paid,
                'price' => $price
            ]);
    }

    /**
     * @param $code
     * @return mixed
     */
    public function getByConfirmCode($code)
    {
        return self::getModel()
            ->where('user', \Auth::user()->id)
            ->where('confirm_code', $code)
            ->first();
    }

    /**
     * @param $code
     * @return mixed
     */
    public function getByConfirmCodeAdmin($code)
    {
        return self::getModel()
            ->where('confirm_code', $code)
            ->first();
    }

    /**
     * @param $code
     * @param $paid
     * @return mixed
     */
    public function setStatus($code, $paid, $status)
    {
        return self::getModel()
            ->where('confirm_code', $code)
            ->update([
                'payment_status' => $paid,
                'card_status' => $status
            ]);
    }

    /**
     * @return mixed
     */
    public function getUserCommand()
    {
        return self::getModel()
            ->where('user', \Auth::user()->id)
            ->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getByIdAndUser($id)
    {
        return self::getModel()
            ->where('user', \Auth::user()->id)
            ->where('id', $id)
            ->first();
    }

    public function getByUser()
    {
        return self::getModel()
            ->active()
            ->where('user', \Auth::user()->id)
            ->get();
    }

}