<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------
 * LavaLust API-Only Routes
 * ------------------------------------------------------------------
 * All endpoints return pure JSON responses.
 */

// Root and Health/Status endpoints
$router->get('/', 'ApiController::index');
$router->get('/api', 'ApiController::index');

// Database seeder route to create or reset the admin user (returns JSON)
$router->match('/setup-admin', 'AuthController::setup_admin', ['GET', 'POST']);
$router->match('/api/setup-admin', 'AuthController::setup_admin', ['GET', 'POST']);

// JSON API authentication endpoints
$router->match('/api/auth/login', 'AuthController::api_login', ['POST', 'OPTIONS']);
$router->match('/api/auth/refresh', 'AuthController::api_refresh', ['POST', 'OPTIONS']);
$router->match('/api/auth/register', 'AuthController::api_register', ['POST', 'OPTIONS']);
$router->match('/api/auth/logout', 'AuthController::api_logout', ['POST', 'OPTIONS']);

// Fallbacks for authentication endpoints without the /api prefix
$router->match('/auth/login', 'AuthController::api_login', ['POST', 'OPTIONS']);
$router->match('/auth/refresh', 'AuthController::api_refresh', ['POST', 'OPTIONS']);
$router->match('/auth/register', 'AuthController::api_register', ['POST', 'OPTIONS']);
$router->match('/auth/logout', 'AuthController::api_logout', ['POST', 'OPTIONS']);
$router->match('/create', 'AuthController::api_register', ['POST', 'OPTIONS']);
$router->match('/login', 'AuthController::login', ['GET', 'POST', 'OPTIONS']);
$router->match('/logout', 'AuthController::logout', ['GET', 'POST', 'OPTIONS']);

// Product API with /api prefix (Protected by api_auth middleware)
$router->group(['prefix' => '/api/products', 'middleware' => ['api_auth']], function() use ($router) {
    $router->match('/', 'ProductApiController::index', ['GET', 'OPTIONS']);
    $router->match('/{id}', 'ProductApiController::show', ['GET', 'OPTIONS']);
    $router->match('/', 'ProductApiController::store', ['POST', 'OPTIONS']);
    $router->match('/{id}', 'ProductApiController::update', ['PUT', 'PATCH', 'OPTIONS']);
    $router->match('/{id}', 'ProductApiController::destroy', ['DELETE', 'OPTIONS']);
});

// Fallback Product API without /api prefix (Protected by api_auth middleware)
$router->group(['prefix' => '/products', 'middleware' => ['api_auth']], function() use ($router) {
    $router->match('/', 'ProductApiController::index', ['GET', 'OPTIONS']);
    $router->match('/{id}', 'ProductApiController::show', ['GET', 'OPTIONS']);
    $router->match('/', 'ProductApiController::store', ['POST', 'OPTIONS']);
    $router->match('/{id}', 'ProductApiController::update', ['PUT', 'PATCH', 'OPTIONS']);
    $router->match('/{id}', 'ProductApiController::destroy', ['DELETE', 'OPTIONS']);
});

// Database Migration endpoints
$router->get('/create-migration/{migration_class}', 'MigrationController::create_migration');
$router->get('/migrate', 'MigrationController::migrate');
$router->get('/rollback', 'MigrationController::rollback');
$router->get('/rollback-all', 'MigrationController::rollback_all');
$router->get('/refresh', 'MigrationController::refresh');
$router->get('/status', 'MigrationController::status');