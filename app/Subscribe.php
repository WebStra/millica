<?php
namespace App;

use Keyhunter\Administrator\Repository;
use App\Libraries\ActivateableTrait;

/**
 * Class Subscribe
 * @package App
 */
class Subscribe extends Repository
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'subscribers';

    /**
     * @var array
     */
    protected $fillable = ['email', 'token', 'active'];


}
