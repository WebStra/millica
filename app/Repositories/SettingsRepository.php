<?php
namespace App\Repositories;

use App\User;
use Auth;

/**
 * Class SettingsRepository
 * @package App\Repositories
 */
class SettingsRepository extends Repository
{

    /**
     * @return User
     */
    public function getModel()
    {
        return new User();
    }

    /**
     * @return mixed
     */
    public function updateSettings()
    {
        return self::getModel()
            ->whereUser(\Auth::user())
            ->first();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function updateProfile(array $data)
    {

        return \Auth::user()
            ->update([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'judet' => $data['judet'],
                'location' => $data['location'],
                'adress' => $data['adress'],
            ]);
    }

    /**
     * @param $password
     * @return mixed
     */
    public function updatePassword($password)
    {
        return \Auth::user()
            ->update([
                'password' => $this->hashPassword($password)
            ]);
    }

    /**
     * @param $password
     * @return string
     */
    public function hashPassword($password)
    {
        return bcrypt($password);
    }

}