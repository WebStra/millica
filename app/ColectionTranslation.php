<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColectionTranslation extends Model
{
    /**
     * @var string
     */
    protected $table = 'colection_translation';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'title', 'colection_id'
    ];
}