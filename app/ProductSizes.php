<?php
namespace App;

use Keyhunter\Administrator\Repository;
use App\Libraries\ActivateableTrait;

/**
 * Class Subscribe
 * @package App
 */
class ProductSizes extends Repository
{
    use ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'prod_sizes';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'title', 'count', 'active'];

}
