<?php

use Illuminate\Support\Str;

return [

    /*
    | Default Session Driver
    | Disarankan menggunakan 'file' untuk lokal jika 'database' sering bermasalah.
    */
    'driver' => env('SESSION_DRIVER', 'file'), // Ubah default ke 'file'

    'lifetime' => (int) env('SESSION_LIFETIME', 120),

    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    'encrypt' => env('SESSION_ENCRYPT', false),

    'files' => storage_path('framework/sessions'),

    'connection' => env('SESSION_CONNECTION'),

    'table' => env('SESSION_TABLE', 'sessions'),

    'store' => env('SESSION_STORE'),

    'lottery' => [2, 100],

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug((string) env('APP_NAME', 'laravel')).'-session'
    ),

    'path' => env('SESSION_PATH', '/'),

    /*
    | Pastikan domain bernilai null agar cookie bisa diterima di localhost/IP.
    */
    'domain' => env('SESSION_DOMAIN', null), // Tambahkan default null

    'secure' => env('SESSION_SECURE_COOKIE', false), // Tambahkan default false

    'http_only' => env('SESSION_HTTP_ONLY', true),

    /*
    | Penting untuk CSRF: 'lax' adalah pilihan terbaik untuk keamanan dan fungsionalitas.
    */
    'same_site' => env('SESSION_SAME_SITE', 'lax'),

    'partitioned' => env('SESSION_PARTITIONED_COOKIE', false),

];
