<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentMiddleware
{
    public function handle(Closure $next)
    {
        if (
            isset($_SESSION['student_access']) &&
            $_SESSION['student_access'] === true
        ) {
            return $next();
        }

        redirect('student');
        exit;
    }
}