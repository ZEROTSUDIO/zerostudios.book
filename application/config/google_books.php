<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Google Books API Configuration
|--------------------------------------------------------------------------
| Reads from environment variable or root .env file.
*/

$api_key = getenv('GOOGLE_BOOKS_API_KEY');

if (!$api_key && file_exists(FCPATH . '.env')) {
    $env_lines = file(FCPATH . '.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($env_lines as $line) {
        $line = trim($line);
        if ($line === '' || strpos($line, '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($key, $val) = explode('=', $line, 2);
            if (trim($key) === 'GOOGLE_BOOKS_API_KEY') {
                $api_key = trim($val);
                break;
            }
        }
    }
}

$config['google_books_api_key'] = $api_key ?: 'AIzaSyDRTSJJuJ1BgM8skE5_SYEcpSvOc3xOOVI';
