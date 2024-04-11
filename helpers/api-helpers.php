<?php
/** PHP Reused code that has to do with dealing with external API services */
require_once '../vendor/autoload.php';

// Set up Cloudinary Work Environment
use Cloudinary\Cloudinary;

function init_cloudinary($cloud_name, $api_key, $api_secret)
{
    /** Initialize Cloudinary for later usage */
    $cloudinary = new Cloudinary(
        [
            'cloud' => [
                'cloud_name' => $cloud_name,
                'api_key'    => $api_key,
                'api_secret' => $api_secret,
            ],
        ]
    );

    return $cloudinary;
}

function upload_base64_to_cloudinary($cloudinary_obj, $base64_data, $image_id)
{
    /** Upload the Base64 data of an image to cloudinary */
    return $cloudinary_obj->uploadApi()->upload(
        $base64_data,
        ["public_id" => $image_id]
    );
}
?>