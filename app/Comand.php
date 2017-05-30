<?php
namespace App;

use Keyhunter\Administrator\Repository;
use App\Libraries\ActivateableTrait;

/**
 * Class Subscribe
 * @package App
 */
class Comand extends Repository
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'comand';

    /**
     * @var array
     */
    protected $fillable = [
        'user',
        'delname',
        'delphone',
        'deladress',
        'deljudet',
        'dellocation',
        'facname',
        'facphone',
        'facadress',
        'facjudet',
        'faclocation',
        'payment',
        'contname',
        'contphone',
        'payment_status',
        'active',
        'price',
        'confirm_code',
        'awb_code',
        'promo_code'
    ];

}
