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

    public function index()
    {
        $this->api->require_method('GET');
        $this->api->respond(['data' => $this->Product_model->all()]);
    }

    public function show($id)
    {
        $this->api->require_method('GET');
        $product = $this->Product_model->find($id);
        if (!$product) $this->api->respond_error('Product not found.', 404);
        $this->api->respond(['data' => $product]);
    }

    public function store()
    {
        $this->api->require_method('POST');
        $input = $this->api->body();
        $data = $this->validated_data($input, true);
        if (isset($data['error'])) $this->api->respond_error($data['error'], 422);
        $productId = $this->Product_model->insert($data);
        $this->api->respond(['message' => 'Product created.', 'data' => $this->Product_model->find($productId)], 201);
    }

    public function update($id)
    {
        $this->api->require_method($_SERVER['REQUEST_METHOD']);
        $product = $this->Product_model->find($id);
        if (!$product) $this->api->respond_error('Product not found.', 404);
        $data = $this->validated_data($this->api->body(), false);
        if (isset($data['error'])) $this->api->respond_error($data['error'], 422);
        $this->Product_model->update_by_id($id, $data);
        $this->api->respond(['message' => 'Product updated.', 'data' => $this->Product_model->find($id)]);
    }

    public function destroy($id)
    {
        $this->api->require_method('DELETE');
        if (!$this->Product_model->find($id)) $this->api->respond_error('Product not found.', 404);
        $this->Product_model->delete_by_id($id);
        $this->api->respond(['message' => 'Product deleted.']);
    }

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
            return ['error' => 'price must be a non-negative amount with up to 10 digits and 2 decimal places.'];
        }
        if (array_key_exists('quantity', $data) && (filter_var($data['quantity'], FILTER_VALIDATE_INT) === false || (int) $data['quantity'] < 0)) {
            return ['error' => 'quantity must be a non-negative integer.'];
        }
        return $data;
    }
}
