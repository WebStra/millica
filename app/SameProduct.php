<?php
namespace App;

use Keyhunter\Administrator\Repository;
use App\Libraries\ActivateableTrait;
use App\Product;

/**
 * Class Subscribe
 * @package App
 */
class SameProduct extends Repository
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'same_product';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'active', 'this_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, 'id', 'this_id');
    }
}
