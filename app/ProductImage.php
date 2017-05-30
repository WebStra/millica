<?php
namespace App;

use Keyhunter\Administrator\Repository;

/**
 * Class Subscribe
 * @package App
 */
class ProductImage extends Repository
{

    /**
     * @var string
     */
    protected $table = 'product_image';

    /**
     * @var array
     */
    protected $fillable = ['original_name', 'filename', 'product_id'];

    public static $rules = [
        'file' => 'required|mimes:png,gif,jpeg,jpg,bmp'
    ];

    public static $messages = [
        'file.mimes' => 'Uploaded file is not in image format',
        'file.required' => 'Image is required'
    ];

}
