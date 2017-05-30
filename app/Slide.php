<?php

namespace App;

use App\Libraries\ActivateableTrait;
use Keyhunter\Administrator\Repository;
use Keyhunter\Translatable\HasTranslations;
use Keyhunter\Translatable\Translatable;

class Slide extends Repository
{
    use HasTranslations, ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'slide';

    /**
     * @var array
     */
    protected $fillable = ['image', 'meta', 'active'];

    /**
     * @var array
     */
    public $translatedAttributes = ['title','subtitle'];

    /**
     * @var SlideTranslation
     */
    public $translationModel = SlideTranslation::class;
}