<?php

namespace App;

use App\Libraries\ActivateableTrait;
use Keyhunter\Administrator\Repository;
use Keyhunter\Translatable\HasTranslations;
use Keyhunter\Translatable\Translatable;
use App\Product;

/**
 * Class Category
 * @package App
 */
class Category extends Repository
{
    use HasTranslations, ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'category';

    /**
     * @var array
     */
    protected $fillable = ['active'];

    /**
     * @var array
     */
    public $translatedAttributes = ['title', 'category_id'];

    /**
     * @var CategoryTranslation
     */
    public $translationModel = CategoryTranslation::class;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getCategoryProducts()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}