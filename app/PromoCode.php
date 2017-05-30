<?php
namespace App;

use Keyhunter\Administrator\Repository;
use App\Libraries\ActivateableTrait;
use App\PromoCategory;

/**
 * Class Subscribe
 * @package App
 */
class PromoCode extends Repository
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'promo_code';

    /**
     * @var array
     */
    protected $fillable = ['code', 'start_date', 'end_date', 'type', 'category', 'value', 'active'];

    /**
     * @return mixed
     */
    public function getPromoCategory()
    {
        return $this->hasMany(PromoCategory::class, 'promo_id', 'id');
    }
}
