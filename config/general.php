<?php

return [
    'limitData' => env('DATA_LIMIT', 10),
    'uploadSlideFolder' => 'images/slider/',
    'uploadThemesFolder' => 'images/themes/',
    'uploadNewsFolder' => 'images/news/',
    'uploadFitureFolder' => 'images/fiture/',
    'uploadProfileFolder' => 'images/profile/',
    'domain' => [
    		'member' => env('MEMBER_URL', 'https://www.arkadia.me/'),
    		'melon' => env('MELON_URL', 'https://melon.arkadia.me/')
    ]
];
