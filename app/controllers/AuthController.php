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

    /** API login: accepts username and password and returns short-lived JWTs. */
    public function api_login()
    {
        $this->call->library('api');
        $this->call->database();
        $this->api->require_method('POST');
        $input = json_decode(file_get_contents('php://input'), true);
        $input = is_array($input) ? $input : $_POST;
        $username = trim((string) ($input['username'] ?? ''));
        $password = (string) ($input['password'] ?? '');

        if ($username === '' || $password === '') {
            $this->api->respond_error('Username and password are required.', 422);
        }

        $query = $this->db->raw(
            'SELECT * FROM users WHERE username = ? LIMIT 1',
            [$username]
        );
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if (!$user || (array_key_exists('is_active', $user) && !(int) $user['is_active']) || !password_verify($password, (string) ($user['password'] ?? ''))) {
            $this->api->respond_error('Invalid credentials.', 401);
        }

        $tokens = $this->api->issue_tokens([
            'id' => (int) $user['id'],
            'role' => $user['role'] ?? 'user',
            'scopes' => ['products:read', 'products:write'],
        ]);
        $safeUser = [
            'id' => (int) $user['id'],
            'username' => $user['username'],
            'email' => $user['email'] ?? null,
            'firstname' => $user['firstname'] ?? null,
            'lastname' => $user['lastname'] ?? null,
            'role' => $user['role'] ?? 'user',
        ];
        $this->api->respond(['data' => ['user' => $safeUser, 'tokens' => $tokens]], 200);
    }

    /** Rotate a refresh token and issue a new access token pair. */
    public function api_refresh()
    {
        $this->call->library('api');
        $this->call->database();
        $this->api->require_method('POST');
        $input = json_decode(file_get_contents('php://input'), true);
        $input = is_array($input) ? $input : $_POST;
        $refreshToken = (string) ($input['refresh_token'] ?? '');
        if ($refreshToken === '') {
            $this->api->respond_error('Refresh token is required.', 422);
        }
        $this->api->refresh_access_token($refreshToken);
    }

    /** Helper method to create or reset the admin user in the database */
    public function setup_admin()
    {
        $this->call->database();
        $username = 'admin';
        $plainPassword = 'password123';
        $hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);

        $check = $this->db->raw('SELECT id FROM users WHERE username = ? LIMIT 1', [$username]);
        $existing = $check->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            $this->db->raw('UPDATE users SET password = ? WHERE username = ?', [$hashedPassword, $username]);
            echo "Admin password updated to: <b>password123</b>";
        } else {
            $this->db->raw(
                'INSERT INTO users (username, password, role) VALUES (?, ?, ?)',
                [$username, $hashedPassword, 'admin']
            );
            echo "Admin user created! Username: <b>admin</b> | Password: <b>password123</b>";
        }
    }
}