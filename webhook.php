<?php
// ✅ Send instant success response to Telegram
ignore_user_abort(true);
header('Content-Type: application/json');
http_response_code(200);
echo json_encode(['ok' => true]);
flush(); // respond immediately to prevent Telegram retries

// ✅ Log errors for debugging
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php-error.log');

// ✅ Read Telegram update (JSON)
$data = file_get_contents('php://input');
$input = json_decode($data, true);

// ✅ If a valid update exists, run bot logic inline (no exec)
if ($input) {
    // Make Telegram input globally accessible (for bot.php)
    $GLOBALS['input_data'] = $input;
    
file_put_contents(__DIR__ . '/debug.log', print_r($input, true), FILE_APPEND);

    // ✅ Correct relative path (same directory)
    require_once __DIR__ . '/bot.php';
}
?>
