<?php
session_start();
header('Content-Type: application/json');
include 'db_connect.php';

$result = $conn->query("SELECT id, name, email, contact, address 
                        FROM users 
                        WHERE role = 'user' 
                        ORDER BY id ASC");

$users = [];
while ($user = $result->fetch_assoc()) {
    $user_id = $user['id'];

    $orderResult = $conn->query("SELECT id, total, status, created_at 
                                 FROM orders 
                                 WHERE user_id = $user_id 
                                 ORDER BY created_at DESC");

    $orders = [];
    while ($order = $orderResult->fetch_assoc()) {
        $orders[] = $order;
    }

    $user['orders'] = $orders;
    $users[] = $user;
}

echo json_encode(["success" => true, "users" => $users]);
?>
