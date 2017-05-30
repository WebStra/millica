<?php

namespace App;

use App\Libraries\ActivateableTrait;
use Keyhunter\Administrator\Repository;
use Keyhunter\Translatable\HasTranslations;
use Keyhunter\Translatable\Translatable;

/**
 * Class Colection
 * @package App
 */
class Colection extends Repository
{
    use HasTranslations, ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'colection';

    /**
     * @var array
     */
    protected $fillable = ['active','image'];

    /**
     * @var array
     */
    public $translatedAttributes = ['title','colection_id'];

    /**
     * @var ColectionTranslation
     */
    public $translationModel = ColectionTranslation::class;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getColectionProducts()
    {
        return $this->hasMany(Product::class, 'colection_id', 'id');
    }
}