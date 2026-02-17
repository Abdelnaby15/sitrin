<?php

return [

    'domain' => env('SESSION_DOMAIN'),

    'path' => '/',

    'secure' => env('SESSION_SECURE_COOKIE', false),

    'sameSite' => 'lax',

];
