<?php

return [
    'cloud' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        'key'        => env('CLOUDINARY_KEY'),
        'secret'     => env('CLOUDINARY_SECRET'),
    ],
    'url' => [
        'secure' => (bool) env('CLOUDINARY_SECURE', true),
    ],
    'upload_preset' => env('CLOUDINARY_UPLOAD_PRESET'),
];
