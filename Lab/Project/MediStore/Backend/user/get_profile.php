<?php
session_start();
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "medistore_db");
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "DB connection failed"]);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT name, email, contact, address FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $profile = $result->fetch_assoc();
    echo json_encode(["success" => true, "data" => $profile]);
} else {
    echo json_encode(["success" => false, "message" => "Profile not found"]);
}
?>
