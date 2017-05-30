<?php
namespace App;

use Keyhunter\Administrator\Repository;
use App\Libraries\ActivateableTrait;
use App\Product;

/**
 * Class Subscribe
 * @package App
 */
class ProductComand extends Repository
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'product_comand';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'comand_id', 'user_id', 'color', 'size', 'quantity', 'price', 'active','promo_code'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
