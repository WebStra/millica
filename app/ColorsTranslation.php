<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColorsTranslation extends Model
{
    /**
     * @var string
     */
    protected $table = 'colors_translation';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'title', 'sizes_id'
    ];
}