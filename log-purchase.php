<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // السماح بالوصول من أي نطاق

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if ($data) {
    $log_file = 'purchase_log.txt';
    $log_entry = "Timestamp: {$data['timestamp']}, Name: {$data['fullName']}, Email: {$data['email']}, Phone: {$data['phoneNumber']}, Payment Method: {$data['paymentMethod']}\n";
    file_put_contents($log_file, $log_entry, FILE_APPEND);
    echo json_encode(['status' => 'success', 'message' => 'Log saved']);
} else {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
}
?>