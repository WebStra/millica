<?php
namespace App;

use Keyhunter\Administrator\Repository;
use App\Libraries\ActivateableTrait;
/**
 * Class Subscribe
 * @package App
 */
class PromoCategory extends Repository
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'promo_categories';

    /**
     * @var array
     */
    protected $fillable = ['category_id', 'promo_id', 'active'];


}
