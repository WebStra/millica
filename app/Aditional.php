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
class Aditional extends Repository
{
    use HasTranslations, ActivateableTrait;

    /**
     * @var string
     */
    protected $table = 'addition';

    /**
     * @var array
     */
    protected $fillable = ['active'];

    /**
     * @var array
     */
    public $translatedAttributes = ['title', 'addition_id'];

    /**
     * @var AditionalTranslation
     */
    public $translationModel = AditionalTranslation::class;

}