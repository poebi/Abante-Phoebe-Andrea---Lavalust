<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$status = http_response_code();
if (!$status || $status < 400) {
    $status = 500;
    http_response_code(500);
}

header('Content-Type: application/json; charset=UTF-8');
echo json_encode([
    'success' => false,
    'message' => !empty($message) ? strip_tags($message) : 'An error occurred',
    'status'  => $status
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
exit();