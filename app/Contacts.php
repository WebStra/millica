<?php
namespace App;

use Keyhunter\Administrator\Repository;
use App\Libraries\ActivateableTrait;

/**
 * Class Subscribe
 * @package App
 */
class Contacts extends Repository
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'contact';

    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'phone', 'subject', 'active'];

}
