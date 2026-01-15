<?php
session_start();
header('Content-Type: application/json');
include 'db_connect.php';

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($id <= 0) {
    echo json_encode(["success" => false, "message" => "Invalid user ID"]);
    exit;
}

$stmt = $conn->prepare("DELETE FROM users WHERE id=? AND role='user'");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "User deleted successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Delete failed: " . $conn->error]);
}
?>
