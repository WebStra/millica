<?php
namespace App\Events;

use App\User;
use Illuminate\Queue\SerializesModels;

/**
 * Class UserCreationRequestSent
 * @package App\Events
 */
class UserCreationRequestSent extends Event
{
    use SerializesModels;

    /**
     * @var User
     */
    protected $user;

    /**
     * UserCreationRequestSent constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser()
    {
       return $this->user;
    }

}