<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware
{
    public function handle(Closure $next)
    {
        $LAVA = lava_instance();
        $LAVA->call->library('session');

        if ($LAVA->session->userdata('is_logged_in') === true) {
            return $next();
        }

        redirect('login');
        exit;
    }
}
