<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('session');
        $this->call->library('form_validation');
    }

    public function login()
    {
        if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
            if (isset($_SESSION['role']) && $_SESSION['role'] === 'student') {
                redirect('student');
            } else {
                redirect('products');
            }
        }

        if ($this->form_validation->submitted()) {
            $username = $this->io->post('username');
            $password = $this->io->post('password');

            if ($username === 'admin' && $password === 'password123') {
                $this->session->set_userdata([
                    'is_logged_in' => true,
                    'user_id' => 1,
                    'username' => 'admin',
                    'role' => 'admin'
                ]);
                redirect('products');
            } elseif ($username === 'student' && $password === 'student123') {
                $this->session->set_userdata([
                    'is_logged_in' => true,
                    'user_id' => 2,
                    'username' => 'student',
                    'role' => 'student'
                ]);
                redirect('student');
            } else {
                $this->session->set_flashdata('error', 'Invalid username or password');
                redirect('login');
            }
        }

        $this->call->view('login');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
