<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    // 'paths' => ['api/*','article/posts/index_data_user','article/posts/index_data_merchant','imagecarousel','jobs/jobposts/index_data'],
    'paths' => ['api/*','article/posts/index_data_user','article/posts/index_data_merchant','imagecarousel','users/careers/index_data','sendmailcontact'],
    // 'paths' => ['api/*','article/posts/*','imagecarousel','jobs/jobposts/index_data','index_data_user','index_data_merchant'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => false,

    'max_age' => false,

    'supports_credentials' => false,

];
