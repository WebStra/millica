<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use App\ProductImage;


class ImageRepository
{
    public function upload($form_data, $id)
    {
        $validator = Validator::make($form_data, ProductImage::$rules, ProductImage::$messages);

        if ($validator->fails()) {

            return Response::json([
                'error' => true,
                'message' => $validator->messages()->first(),
                'code' => 400
            ], 400);

        }

        $photo = $form_data['file'];

        $originalName = $photo->getClientOriginalName();
        $extension = $photo->getClientOriginalExtension();
        $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) - 1);

        $filename = $this->sanitize($originalNameWithoutExt);
        $allowed_filename = $this->createUniqueFilename($filename, $extension);

        $uploadSuccess1 = $this->original($photo, $allowed_filename);

        if (!$uploadSuccess1) {

            return Response::json([
                'error' => true,
                'message' => 'Server error while uploading',
                'code' => 500
            ], 500);

        }

        $sessionImage = new ProductImage;
        $sessionImage->filename = $allowed_filename;
        $sessionImage->original_name = $originalName;
        $sessionImage->full_name = '/upload/products/'.$allowed_filename;
        $sessionImage->product_id = $id;
        $sessionImage->save();

        return Response::json([
            'error' => false,
            'code' => 200
        ], 200);

    }

    public function createUniqueFilename($filename, $extension)
    {
        $full_size_dir = public_path(). '/upload/products/';
        $full_image_path = $full_size_dir . $filename . '.' . $extension;

        if (File::exists($full_image_path)) {
            // Generate token for image
            $imageToken = substr(sha1(mt_rand()), 0, 5);
            return $filename . '-' . $imageToken . '.' . $extension;
        }

        return $filename . '.' . $extension;
    }

    /**
     * Optimize Original Image
     */
    public function original($photo, $filename)
    {
        $manager = new ImageManager();
        $image = $manager->make($photo)->save(public_path(). '/upload/products/' . $filename);

        return $image;
    }


    /**
     * Delete Image From Session folder, based on original filename
     */
    public function delete($allowed_filename)
    {

        $full_size_dir = public_path(). '/upload/products/';

        $sessionImage = ProductImage::where('original_name', 'like', $allowed_filename)->first();


        if (empty($sessionImage)) {
            return Response::json([
                'error' => true,
                'code' => 400
            ], 400);

        }

        $full_path1 = $full_size_dir . $sessionImage->filename;

        if (File::exists($full_path1)) {
            File::delete($full_path1);
        }

        if (!empty($sessionImage)) {
            $sessionImage->delete();
        }

        return Response::json([
            'error' => false,
            'code' => 200
        ], 200);
    }

    function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean;

        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }
}