<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SizesTranslation extends Model
{
    /**
     * @var string
     */
    protected $table = 'sizes_translation';

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