<!-- <?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit;
}

$conn = new mysqli("localhost", "root", "", "medistore_db");
$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT id, name, email, phone, address FROM users WHERE id=$user_id");
if ($row = $result->fetch_assoc()) {
    echo json_encode(["success" => true, "user" => $row]);
} else {
    echo json_encode(["success" => false, "message" => "User not found"]);
}
?> -->
