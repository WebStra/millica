<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonTranslation extends Model
{
    /**
     * @var string
     */
    protected $table = 'seasons_translation';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'title', 'season_id'
    ];
}