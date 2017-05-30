<?php
namespace App\Repositories;

use App\User;
use Auth;

/**
 * Class UserRegisterRepository
 * @package App\Repositories
 */
class UserRegisterRepository extends Repository
{

    /**
     * @var RolesRepository
     */
    protected $role;

    /**
     * UserRegisterRepository constructor.
     * @param RolesRepository $rolesRepository
     */
    public function __construct(RolesRepository $rolesRepository)
    {
        $this->role = $rolesRepository;
    }

    /**
     * @return User
     */
    public function getModel()
    {
        return new User();
    }

    /**
     * @return User
     */
    static public function staticGetModel()
    {
        return new User();
    }

    /**
     * @param array $data
     * @param int $confirmed
     * @return static
     */
    public function createSimpleUser(array $data, $confirmed = 1)
    {
        return self::getModel()
            ->create([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => $this->hashPassword($data['password']),
                'verify_token' => str_random(30),
                'active' => $confirmed,
                'role_id' => $this->simpleUser()->id
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

    /**
     * @param $request
     * @return mixed
     */
    public function updatePassword($request){
        return self::getModel()
            ->where('verify_token', $request->verify_token)
            ->update([
                'password' => $this->hashPassword($request->password)
            ]);

    }

    /**
     * @return mixed
     */
    public function simpleUser()
    {
        return $this->role->getSimpleUserRole();
    }

    /**
     * @param $code
     * @return mixed
     */
    public function getByConfirmationCode($code)
    {
        return self::getModel()
            ->where('verify_token', $code)
            ->first();
    }

    /**
     * @param $user
     */
    public function confirmate($user)
    {
        $user->active = (int)true;
        $user->save();
    }

    /**
     * @param $email
     * @return mixed
     */
    public function getByEmail($email)
    {
        return self::getModel()
            ->whereEmail($email)
            ->first();
    }

}