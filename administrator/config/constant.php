<?php
return [
    'default' => env('IMAGE_SIZE', 'thumbnail'),
    'imageSize' => [
        'thumbnail' => [120,120],
        'profile' => ['width'=>227,'height'=>220],
    ],
    'absoluteMediaPath' => env('APP_URL').'public/upload',
    'relativeMediaPath' => 'public/upload',
];