<?php
session_start();
header('Content-Type: application/json');
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
    echo json_encode(["success" => false, "message" => "Invalid input"]);
    exit;
}

$name     = trim($data['name'] ?? '');
$email    = trim(strtolower($data['email'] ?? ''));
$password = $data['password'] ?? '';
$contact  = trim($data['contact'] ?? '');
$role     = trim($data['role'] ?? 'user');
$address  = trim($data['address'] ?? 'Not Updated');

$conn = new mysqli("localhost", "root", "", "medistore_db");
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "DB connection failed"]);
    exit;
}

$stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "Email already registered"]);
    exit;
}

$hashed = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (name, email, contact, address, password, role) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $name, $email, $contact, $address, $hashed, $role);

if ($stmt->execute()) {
    $user_id = $stmt->insert_id;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $name;
    $_SESSION['user_role'] = $role;

    echo json_encode([
        "success" => true,
        "user" => [
            "id" => $user_id,
            "name" => $name,
            "email" => $email,
            "role" => $role
        ]
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Signup failed"]);
}
?>
