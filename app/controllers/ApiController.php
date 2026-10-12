<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('api');
    }

    /**
     * Root / API status endpoint.
     */
    public function index()
    {
        $this->api->respond([
            'success' => true,
            'message' => 'LavaLust API backend is operational.',
            'data' => [
                'name'    => 'LavaLust API',
                'status'  => 'online',
                'version' => '1.0.0',
                'endpoints' => [
                    'POST /api/auth/login'    => 'Authenticate and receive JWT tokens',
                    'POST /api/auth/refresh'  => 'Refresh access token with refresh token',
                    'POST /api/auth/register' => 'Register a new user account',
                    'POST /api/auth/logout'   => 'Stateless logout',
                    'GET /api/products'       => 'List all products (Bearer token required)',
                    'POST /api/products'      => 'Create a new product (Bearer token required)',
                    'GET /api/products/{id}'  => 'Get a product by ID (Bearer token required)',
                    'PUT /api/products/{id}'  => 'Update a product by ID (Bearer token required)',
                    'DELETE /api/products/{id}'=> 'Delete a product by ID (Bearer token required)',
                ]
            ]
        ], 200);
    }
}
