<?php
ignore_user_abort(true);
header('Content-Type: application/json');
http_response_code(200);
echo json_encode(['ok' => true]);
flush(); // respond immediately to Telegram

ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php-error.log');

// Read input
$data = file_get_contents('php://input');
if (!$data) {
    $data = json_encode($_POST ?? []);
}

file_put_contents(__DIR__ . '/debug.log', date('Y-m-d H:i:s') . " | Input: $data\n", FILE_APPEND);

// Decode and pass to bot
$update = json_decode($data, true);
if (!empty($update)) {
    // Make $update available to bot.php
    $GLOBALS['update'] = $update;

    // Safely include your bot logic
    require_once __DIR__ . '/bot.php';
} else {
    file_put_contents(__DIR__ . '/debug.log', date('Y-m-d H:i:s') . " | Empty update received\n", FILE_APPEND);
}
?>
