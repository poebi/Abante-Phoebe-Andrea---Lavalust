<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('api');
        $this->call->database();
    }

    /**
     * API login: accepts username and password and returns short-lived JWTs.
     */
    public function api_login()
    {
        $this->api->require_method('POST');
        $input = $this->api->body();
        if (empty($input)) {
            $raw = json_decode(file_get_contents('php://input'), true);
            $input = is_array($raw) ? $raw : $_POST;
        }

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
            $this->api->respond_error('Invalid username or password.', 401);
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
            'role' => $user['role'] ?? 'user',
        ];

        $this->api->respond([
            'success' => true,
            'message' => 'Login successful.',
            'data' => [
                'user' => $safeUser,
                'tokens' => $tokens
            ],
            // Fallback top-level properties for versatile frontend client decoders
            'user' => $safeUser,
            'tokens' => $tokens
        ], 200);
    }

    /**
     * Rotate a refresh token and issue a new access token pair.
     */
    public function api_refresh()
    {
        $this->api->require_method('POST');
        $input = $this->api->body();
        if (empty($input)) {
            $raw = json_decode(file_get_contents('php://input'), true);
            $input = is_array($raw) ? $raw : $_POST;
        }
        $refreshToken = (string) ($input['refresh_token'] ?? '');
        if ($refreshToken === '') {
            $this->api->respond_error('Refresh token is required.', 422);
        }
        $this->api->refresh_access_token($refreshToken);
    }

    /**
     * API Register: Create a new user account.
     */
    public function api_register()
    {
        $this->api->require_method('POST');
        $input = $this->api->body();
        if (empty($input)) {
            $raw = json_decode(file_get_contents('php://input'), true);
            $input = is_array($raw) ? $raw : $_POST;
        }

        $username = trim((string) ($input['username'] ?? ''));
        $email = trim((string) ($input['email'] ?? ''));
        $password = (string) ($input['password'] ?? '');
        $role = trim((string) ($input['role'] ?? 'user'));

        if ($username === '' || $password === '' || $email === '') {
            $this->api->respond_error('Username, email, and password are required.', 422);
        }

        if (strlen($password) < 6) {
            $this->api->respond_error('Password must be at least 6 characters.', 422);
        }

        $check = $this->db->raw('SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1', [$username, $email]);
        if ($check->fetch()) {
            $this->api->respond_error('Username or email already exists.', 409);
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $this->db->raw(
            'INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)',
            [$username, $email, $hashedPassword, $role]
        );

        $newUserId = (int) $this->db->last_id();

        $this->api->respond([
            'success' => true,
            'message' => 'User created successfully.',
            'data' => [
                'id' => $newUserId,
                'username' => $username,
                'email' => $email,
                'role' => $role
            ]
        ], 201);
    }

    /**
     * API Logout: Stateless logout.
     */
    public function api_logout()
    {
        $this->api->respond([
            'success' => true,
            'message' => 'Logged out successfully.'
        ], 200);
    }

    /**
     * Alias method for web /login compatibility (JSON only).
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return $this->api_login();
        }

        $this->api->respond([
            'success' => false,
            'message' => 'This backend is API-only. Send a POST request with JSON credentials to /api/auth/login.',
            'data' => [
                'expected_method' => 'POST',
                'expected_body' => ['username' => 'your_username', 'password' => 'your_password']
            ]
        ], 405);
    }

    /**
     * Alias method for web /logout compatibility (JSON only).
     */
    public function logout()
    {
        return $this->api_logout();
    }

    /**
     * Helper method to create or reset the admin user in the database (API JSON).
     */
    public function setup_admin()
    {
        $username = 'admin';
        $plainPassword = 'password123';
        $hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);

        $check = $this->db->raw('SELECT id FROM users WHERE username = ? LIMIT 1', [$username]);
        $existing = $check->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            $this->db->raw('UPDATE users SET password = ? WHERE username = ?', [$hashedPassword, $username]);
            $action = 'Admin password updated to password123';
        } else {
            $this->db->raw(
                'INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)',
                [$username, 'admin@example.com', $hashedPassword, 'admin']
            );
            $action = 'Admin user created';
        }

        $this->api->respond([
            'success' => true,
            'message' => $action,
            'data' => [
                'username' => $username,
                'role' => 'admin'
            ]
        ], 200);
    }
}