<?php
ignore_user_abort(true);
header('Content-Type: application/json');
http_response_code(200);
echo json_encode(['ok' => true]);
flush(); // respond immediately so Telegram doesn’t retry

ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php-error.log');

$data = file_get_contents('php://input');
$input = json_decode($data, true);

// Optional: debug log to verify Telegram messages arrive
file_put_contents(__DIR__ . '/debug.log', print_r($input, true), FILE_APPEND);

// Run the bot logic inline (Render-safe)
if ($input) {
    $GLOBALS['input_data'] = $input;
    require_once __DIR__ . '/bot.php';
}
?>
