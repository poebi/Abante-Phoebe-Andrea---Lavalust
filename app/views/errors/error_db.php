<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

while (ob_get_level() > 0) {
    ob_end_clean();
}

header('Content-Type: application/json; charset=UTF-8');
http_response_code(500);

echo json_encode([
    'success' => false,
    'message' => 'A database error occurred. Please contact the administrator.',
    'status'  => 500
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
exit();