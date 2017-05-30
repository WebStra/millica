<?php
namespace App;

use Keyhunter\Administrator\Repository;
use App\Libraries\ActivateableTrait;

/**
 * Class Subscribe
 * @package App
 */
class UsedCodes extends Repository
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'used_promo_codes';

    /**
     * @var array
     */
    protected $fillable = ['code', 'count', 'active'];


}
