<?php

namespace App;

use App\Libraries\ActivateableTrait;
use Keyhunter\Administrator\Repository;
use Keyhunter\Translatable\HasTranslations;
use Keyhunter\Translatable\Translatable;

class Blog extends Repository
{
    use HasTranslations, ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'blog';

    /**
     * @var array
     */
    protected $fillable = ['image', 'author', 'active'];

    /**
     * @var array
     */
    public $translatedAttributes = ['title','body'];

    /**
     * @var BlogTranslation
     */
    public $translationModel = BlogTranslation::class;
}