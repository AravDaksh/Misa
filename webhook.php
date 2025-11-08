<?php

$input = json_decode(file_get_contents('php://input'), true);
ignore_user_abort(true);
header('Content-Type: application/json');
http_response_code(200);
echo json_encode(['ok' => true]);
flush(); // respond immediately so Telegram doesn't retry

ini_set('log_errors', 1);
ini_set('error_log', 'php-error.log');

ignore_user_abort(true);
set_time_limit(0);

$data = file_get_contents('php://input');

exec("nohup php bot.php '".base64_encode($data)."' > /dev/null 2>/dev/null &");

?>
