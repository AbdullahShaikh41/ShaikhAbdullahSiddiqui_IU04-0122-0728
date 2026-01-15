<?php
session_start();
header('Content-Type: application/json');
include 'db_connect.php';

$id      = isset($_POST['id']) ? intval($_POST['id']) : 0;
$name    = isset($_POST['name']) ? $_POST['name'] : '';
$email   = isset($_POST['email']) ? $_POST['email'] : '';
$contact = isset($_POST['contact']) ? $_POST['contact'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';

if ($id <= 0) {
    echo json_encode(["success" => false, "message" => "Invalid user ID"]);
    exit;
}

$stmt = $conn->prepare("UPDATE users SET name=?, email=?, contact=?, address=? WHERE id=? AND role='user'");
$stmt->bind_param("ssssi", $name, $email, $contact, $address, $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "User updated successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Update failed: " . $conn->error]);
}
?>
