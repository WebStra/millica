<?php
namespace App\Repositories;

use App\Subscribe;

/**
 * Class SubscribeRepository
 * @package App\Repositories
 */
class SubscribeRepository extends Repository
{
    /**
     * @return Subscribe
     */
    public function getModel()
    {
        return new Subscribe();
    }

    /**
     * @param $request
     * @return static
     */
    public function addSubscriber($request)
    {
        $query = self::getModel()->create([
            'email' => $request->email,
            'token' => $request->_token
        ]);

        return $query;
    }

    /**
     * @param $email
     * @return mixed
     */
    public function findEmail($email)
    {
        return self::getModel()
            ->where('email', $email)
            ->first();
    }

    /**
     * @param $token
     * @return mixed
     */
    public function unsuscribe($token)
    {
        return self::getModel()
            ->where('token', $token)
            ->update([
                'active' => 0
            ]);
    }

}