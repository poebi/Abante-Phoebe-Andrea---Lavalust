<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiAuthMiddleware
{
    public function handle(Closure $next)
    {
        // Handle preflight OPTIONS requests immediately
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(204);
            exit;
        }

        $lava = lava_instance();
        $lava->call->library('api');
        $lava->call->database();
        $payload = $lava->api->require_jwt();

        if (($payload['type'] ?? 'access') !== 'access') {
            $lava->api->respond_error('An access token is required.', 401);
        }

        return $next();
    }
}
