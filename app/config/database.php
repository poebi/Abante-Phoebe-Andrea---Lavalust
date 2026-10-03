<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$env_value = static function ($name, $default = null) {
    $value = $_ENV[$name] ?? getenv($name);
    return ($value === false || $value === null || $value === '') ? $default : $value;
};

$required_database_env = ['DB_HOST', 'DB_PORT', 'DB_USERNAME', 'DB_PASSWORD', 'DB_DATABASE'];
foreach ($required_database_env as $env_name) {
    if ($env_value($env_name) === null) {
        throw new RuntimeException("Missing required database environment variable: {$env_name}");
    }
}

$database['main'] = [
    'driver'   => $env_value('DB_DRIVER', 'mysql'),
    'hostname' => $env_value('DB_HOST'),
    'port'     => $env_value('DB_PORT'),
    'username' => $env_value('DB_USERNAME'),
    'password' => $env_value('DB_PASSWORD'),
    'database' => $env_value('DB_DATABASE'),
    'charset'  => $env_value('DB_CHARSET', 'utf8mb4'),
    'ssl_ca'   => $env_value('DB_SSL_CA'),
    'dbprefix' => '',
    'path'     => '',
];
