<?php

return [
    'maxLength'      => env('SHORTLINK_SLUG_LENGTH', 6),
    'token'          => env('SHORTLINK_TOKEN'),
    'defaultTtlDays' => env('SHORTLINK_DEFAULT_TTL_DAYS', 30),
    'redirectNotFound' => env('SHORTLINK_REDIRECT_NOT_FOUND'),
    'redirectInactive' => env('SHORTLINK_REDIRECT_INACTIVE'),
];
