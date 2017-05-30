<?php
namespace App;

use Keyhunter\Administrator\Repository;
use App\Libraries\ActivateableTrait;
use App\Product;

/**
 * Class Subscribe
 * @package App
 */
class Basket extends Repository
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'basket';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'user_id', 'user_ip', 'color', 'size', 'quantity', 'price', 'active','promo_code','category_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
