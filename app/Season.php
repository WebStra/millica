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
class Season extends Repository
{
    use HasTranslations, ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'seasons';

    /**
     * @var array
     */
    protected $fillable = ['active'];

    /**
     * @var array
     */
    public $translatedAttributes = ['title', 'seasons_id'];

    /**
     * @var SeasonTranslation
     */
    public $translationModel = SeasonTranslation::class;

}