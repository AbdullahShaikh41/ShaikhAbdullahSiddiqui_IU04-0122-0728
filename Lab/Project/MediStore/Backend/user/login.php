<?php
session_start();
header("Content-Type: application/json");

$host = "localhost";
$user = "root";
$pass = "";
$db   = "medistore_db";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    echo json_encode(["success"=>false,"message"=>"Database connection failed"]);
    exit;
}

$input = json_decode(file_get_contents("php://input"), true);
$email = strtolower(trim($input['email'] ?? ''));
$password = $input['password'] ?? '';

if ($email==='' || $password==='') {
    echo json_encode(["success"=>false,"message"=>"Email and password required"]);
    exit;
}

$stmt = mysqli_prepare($conn, "SELECT id, name, email, password, role FROM users WHERE email=?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

if ($user = mysqli_fetch_assoc($res)) {
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_name'] = $user['name'];

        echo json_encode([
            "success"=>true,
            "message"=>"Login successful",
            "user"=>[
                "id"=>$user['id'],
                "name"=>$user['name'],
                "email"=>$user['email'],
                "role"=>$user['role']
            ]
        ]);
    } else {
        echo json_encode(["success"=>false,"message"=>"Wrong password"]);
    }
} else {
    echo json_encode(["success"=>false,"message"=>"User not found"]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
