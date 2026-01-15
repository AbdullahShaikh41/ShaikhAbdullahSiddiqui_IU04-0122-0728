<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit;
}

$conn = new mysqli("localhost", "root", "", "medistore_db");
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "DB connection failed"]);
    exit;
}

$user_id = $_SESSION['user_id'];
$orderResult = $conn->query("SELECT * FROM orders WHERE user_id=$user_id ORDER BY created_at DESC");

$orders = [];
while ($order = $orderResult->fetch_assoc()) {
    $order_id = $order['id'];

    $itemsResult = $conn->query("SELECT oi.*, p.name 
                                 FROM order_items oi 
                                 JOIN products p ON oi.product_id = p.id 
                                 WHERE oi.order_id=$order_id");

    $items = [];
    while ($item = $itemsResult->fetch_assoc()) {
        $items[] = $item;
    }

    $order['items'] = $items;
    $orders[] = $order;
}

echo json_encode(["success" => true, "orders" => $orders]);
?>
