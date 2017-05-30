<?php
namespace App;

use Keyhunter\Administrator\Repository;
use App\Libraries\ActivateableTrait;
use App\Product;

/**
 * Class Subscribe
 * @package App
 */
class Favorite extends Repository
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'favorite';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'user_id', 'active', 'user_ip'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
