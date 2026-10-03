<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiAuthMiddleware
{
    public function handle(Closure $next)
    {
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
