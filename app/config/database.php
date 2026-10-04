<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$env_value = static function ($name, $default = null) {
    $val = $_ENV[$name] ?? ($_SERVER[$name] ?? getenv($name));
    return ($val === false || $val === null || $val === '') ? $default : $val;
};


defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$active_group = 'default';

$database['main'] = array(
    'hostname' => getenv('DB_HOST') ?: 'mysql-3cd37ed5-phoebeabante18.j.aivencloud.com',
    'username' => getenv('DB_USER') ?: 'avnadmin',
    'password' => getenv('DB_PASSWORD') ?: '',
    'database' => getenv('DB_NAME') ?: 'defaultdb',
    'port'     => (int)(getenv('DB_PORT') ?: 16717),
    'driver'   => 'mysql',
    'ssl_mode' => 'REQUIRED'
);

$ssl_ca_file = $env_value('DB_SSL_CA');
if (!empty($ssl_ca_file) && file_exists($ssl_ca_file)) {
    $database['main']['ssl_ca'] = $ssl_ca_file;
}