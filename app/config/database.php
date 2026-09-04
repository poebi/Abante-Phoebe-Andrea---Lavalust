<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$database['main'] = array(
    'driver'   => $_ENV['DB_DRIVER'] ?? getenv('DB_DRIVER') ?: 'mysql',
    'hostname' => $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?: 'mysql-3cd37ed5-phoebeabante18.j.aivencloud.com',
    'port'     => $_ENV['DB_PORT'] ?? getenv('DB_PORT') ?: '16717',
    'username' => $_ENV['DB_USERNAME'] ?? getenv('DB_USERNAME') ?: 'avnadmin',
    'password' => $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?: 'AVNS_lwfP7XnONBwn5pCs5Fv',
    'database' => $_ENV['DB_DATABASE'] ?? getenv('DB_DATABASE') ?: 'defaultdb',
    'charset'  => 'utf8mb4',
    'dbprefix' => '',
    'path'     => ''
);