<?php
session_start();
header('Content-Type: application/json');
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || empty($data['cart'])) {
    echo json_encode(["success" => false, "message" => "Cart is empty"]);
    exit;
}

$user_id = $_SESSION['user_id'];
$total = $data['total'];
$status = "Pending";

$stmt = $conn->prepare("INSERT INTO orders (user_id, total, status, created_at) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("ids", $user_id, $total, $status);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => $conn->error]);
}
?>
