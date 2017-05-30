<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlideTranslation extends Model
{
    /**
     * @var string
     */
    protected $table = 'slide_translation';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'title', 'subtitle', 'slide_id'
    ];
}