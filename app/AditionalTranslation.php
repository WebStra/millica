<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AditionalTranslation extends Model
{
    /**
     * @var string
     */
    protected $table = 'addition_translation';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'title', 'aditional_id'
    ];
}