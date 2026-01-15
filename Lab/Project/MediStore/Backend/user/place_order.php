<?php
session_start();
header('Content-Type: application/json');
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

$conn = new mysqli("localhost", "root", "", "medistore_db");
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "DB connection failed: " . $conn->connect_error]);
    exit;
}

$input = json_decode(file_get_contents("php://input"), true);

// Cart items and total
$items = $input['items'] ?? [];
$total = floatval($input['total'] ?? 0);

$user_id = intval($_SESSION['user_id'] ?? 0);

if ($user_id === 0 || empty($items) || $total <= 0) {
    echo json_encode(["success" => false, "message" => "Missing required fields"]);
    exit;
}

// Insert order
$status = "Pending";
$stmt = $conn->prepare("INSERT INTO orders (user_id, total, status, created_at) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("ids", $user_id, $total, $status);
if (!$stmt->execute()) {
    echo json_encode(["success" => false, "message" => "Order insert failed: " . $stmt->error]);
    exit;
}
$order_id = $conn->insert_id;

// Insert items
$itemStmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
foreach ($items as $item) {
    $pid   = intval($item['id'] ?? 0);
    $qty   = intval($item['qty'] ?? 0);
    $price = floatval($item['price'] ?? 0);
    $itemStmt->bind_param("iiid", $order_id, $pid, $qty, $price);
    if (!$itemStmt->execute()) {
        echo json_encode(["success" => false, "message" => "Item insert failed: " . $itemStmt->error]);
        exit;
    }
}

echo json_encode(["success" => true, "message" => "Order placed", "order_id" => $order_id]);
?>
