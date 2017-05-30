<?php

namespace App;

use App\Libraries\ActivateableTrait;
use Keyhunter\Administrator\Repository;
use Keyhunter\Translatable\HasTranslations;
use Keyhunter\Translatable\Translatable;
/**
 * Class Category
 * @package App
 */
class Sizes extends Repository
{
    use HasTranslations, ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'sizes';

    /**
     * @var array
     */
    protected $fillable = ['active'];

    /**
     * @var array
     */
    public $translatedAttributes = ['title', 'sizes_id'];

    /**
     * @var SizesTranslation
     */
    public $translationModel = SizesTranslation::class;

}