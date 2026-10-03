<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$env_value = static function ($name, $default = null) {
    $val = $_ENV[$name] ?? ($_SERVER[$name] ?? getenv($name));
    return ($val === false || $val === null || $val === '') ? $default : $val;
};

$database['main'] = [
    'driver'    => $env_value('DB_DRIVER', 'mysql'),
    'hostname'  => $env_value('DB_HOST', 'mysql-3cd37ed5-phoebeabante18.j.aivencloud.com'),
    'port'      => (int) $env_value('DB_PORT', 16717),
    'username'  => $env_value('DB_USERNAME', 'avnadmin'),
    'password'  => $env_value('DB_PASSWORD', ''),
    'database'  => $env_value('DB_DATABASE', 'defaultdb'),
    'charset'   => $env_value('DB_CHARSET', 'utf8mb4'),
    'dbprefix'  => '',
    'path'      => '',
];

$ssl_ca_file = $env_value('DB_SSL_CA');
if (!empty($ssl_ca_file) && file_exists($ssl_ca_file)) {
    $database['main']['ssl_ca'] = $ssl_ca_file;
}