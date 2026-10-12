<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

header('Content-Type: application/json; charset=UTF-8');
http_response_code(404);

echo json_encode([
    'success' => false,
    'message' => !empty($message) ? strip_tags($message) : 'Endpoint not found',
    'status'  => 404
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
exit();