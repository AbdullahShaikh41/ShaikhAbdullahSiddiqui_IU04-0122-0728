<?php
session_start();
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "medistore_db");
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed"]);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit;
}

$user_id = $_SESSION['user_id'];

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$contact = $_POST['contact'] ?? '';
$address = $_POST['address'] ?? '';

$stmt = $conn->prepare("UPDATE users SET name=?, email=?, contact=?, address=? WHERE id=?");
$stmt->bind_param("ssssi", $name, $email, $contact, $address, $user_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Profile updated successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Update failed"]);
}
?>
