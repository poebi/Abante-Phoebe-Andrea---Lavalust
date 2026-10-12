<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductApiController extends Controller
{
    private const FIELDS = ['product_name', 'description', 'price', 'quantity'];

    public function __construct()
    {
        parent::__construct();
        $this->call->library('api');
        $this->call->model('Product_model');
    }

    /**
     * List all products.
     */
    public function index()
    {
        $this->api->require_method('GET');
        $products = $this->Product_model->all();
        $this->api->respond([
            'success' => true,
            'message' => 'Products retrieved successfully.',
            'data'    => $products ?: []
        ], 200);
    }

    /**
     * Show a single product by ID.
     */
    public function show($id)
    {
        $this->api->require_method('GET');
        $product = $this->Product_model->find($id);
        if (!$product) {
            $this->api->respond_error('Product not found.', 404);
        }
        $this->api->respond([
            'success' => true,
            'message' => 'Product retrieved successfully.',
            'data'    => $product
        ], 200);
    }

    /**
     * Create a new product.
     */
    public function store()
    {
        $this->api->require_method('POST');
        $input = $this->api->body();
        $data = $this->validated_data($input, true);
        if (isset($data['error'])) {
            $this->api->respond_error($data['error'], 422);
        }
        $productId = $this->Product_model->insert($data);
        $saved = $this->Product_model->find($productId);
        $this->api->respond([
            'success' => true,
            'message' => 'Product created successfully.',
            'data'    => $saved
        ], 201);
    }

    /**
     * Update an existing product.
     */
    public function update($id)
    {
        if (!in_array($_SERVER['REQUEST_METHOD'], ['PUT', 'PATCH'], true)) {
            $this->api->respond_error('Method Not Allowed. Use PUT or PATCH.', 405);
        }
        $product = $this->Product_model->find($id);
        if (!$product) {
            $this->api->respond_error('Product not found.', 404);
        }
        $data = $this->validated_data($this->api->body(), false);
        if (isset($data['error'])) {
            $this->api->respond_error($data['error'], 422);
        }
        $this->Product_model->update_by_id($id, $data);
        $updated = $this->Product_model->find($id);
        $this->api->respond([
            'success' => true,
            'message' => 'Product updated successfully.',
            'data'    => $updated
        ], 200);
    }

    /**
     * Delete a product.
     */
    public function destroy($id)
    {
        $this->api->require_method('DELETE');
        if (!$this->Product_model->find($id)) {
            $this->api->respond_error('Product not found.', 404);
        }
        $this->Product_model->delete_by_id($id);
        $this->api->respond([
            'success' => true,
            'message' => 'Product deleted successfully.'
        ], 200);
    }

    /**
     * Validate product input.
     */
    private function validated_data(array $input, bool $requireAll)
    {
        $data = array_intersect_key($input, array_flip(self::FIELDS));
        if ($requireAll) {
            foreach (self::FIELDS as $field) {
                if (!array_key_exists($field, $data) || $data[$field] === '') {
                    return ['error' => "Field '{$field}' is required."];
                }
            }
        } elseif (!$data) {
            return ['error' => 'Provide at least one product field to update.'];
        }

        if (isset($data['product_name']) && (!is_string($data['product_name']) || strlen($data['product_name']) > 100 || trim($data['product_name']) === '')) {
            return ['error' => 'product_name must be a non-empty string of at most 100 characters.'];
        }
        if (array_key_exists('description', $data) && $data['description'] !== null && !is_string($data['description'])) {
            return ['error' => 'description must be a string or null.'];
        }
        if (array_key_exists('price', $data) && (!is_scalar($data['price']) || !preg_match('/^\d{1,8}(?:\.\d{1,2})?$/', (string) $data['price']))) {
            return ['error' => 'price must be a non-negative amount with up to 8 integer digits and 2 decimal places.'];
        }
        if (array_key_exists('quantity', $data) && (filter_var($data['quantity'], FILTER_VALIDATE_INT) === false || (int) $data['quantity'] < 0)) {
            return ['error' => 'quantity must be a non-negative integer.'];
        }
        return $data;
    }
}
