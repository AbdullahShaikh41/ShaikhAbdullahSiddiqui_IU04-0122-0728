<?php
session_start();
header('Content-Type: application/json');
include 'db_connect.php';

$result = $conn->query("SELECT o.*, u.name, u.email, u.contact, u.address 
                        FROM orders o 
                        JOIN users u ON o.user_id = u.id 
                        ORDER BY o.created_at DESC");

$orders = [];
while ($order = $result->fetch_assoc()) {
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
