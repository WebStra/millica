<?php

namespace App;

use App\Libraries\ActivateableTrait;
use Keyhunter\Administrator\Repository;
use Keyhunter\Translatable\HasTranslations;
use Keyhunter\Translatable\Translatable;
use Cviebrock\EloquentTaggable\Taggable;
use App\Libraries\Presenterable\Presenterable;
use App\Libraries\Presenterable\Presenters\ProductPresenter;
use Nicolaslopezj\Searchable\SearchableTrait;
use App\ProductImage;
use App\ProductSizes;

/**
 * Class Product
 * @package App
 */
class Product extends Repository
{
    use HasTranslations, ActivateableTrait, Taggable, Presenterable , SearchableTrait;

    /**
     * @var string
     */
    protected $table = 'product';

    /**
     * @var string
     */
    public $presenter = ProductPresenter::class;
    /**
     * @var array
     */
    protected $fillable = [
        'quantity',
        'sale',
        'old_price',
        'price',
        'active',
        'category_id',
        'colection',
        'colection_id'
    ];

    /**
     * @var array
     */
    public $translatedAttributes = ['title', 'body','delivery', 'color'];

    /**
     * @var ProductTranslation
     */
    public $translationModel = ProductTranslation::class;

    protected $searchable = [
        'columns' => [
            'title' => 10
        ],
        'joins' => [
            'product_translation' => ['product.id','product_id'],
        ],
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getImage()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function getSizes()
    {
        return $this->hasMany(ProductSizes::class, 'product_id', 'id');
    }
}