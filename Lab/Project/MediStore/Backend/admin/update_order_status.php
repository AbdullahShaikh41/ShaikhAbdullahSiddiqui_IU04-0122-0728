<?php
header('Content-Type: application/json');
include 'db_connect.php';

$data = json_decode(file_get_contents("php://input"), true);
$order_id = intval($data['order_id']);
$status   = $conn->real_escape_string($data['status']);

$query = "UPDATE orders SET status='$status' WHERE id=$order_id";
if ($conn->query($query)) {
    if ($conn->affected_rows > 0) {
        echo json_encode(["success"=>true,"message"=>"Status updated"]);
    } else {
        echo json_encode(["success"=>false,"message"=>"No rows updated. Query: $query"]);
    }
} else {
    echo json_encode(["success"=>false,"message"=>"Query failed: ".$conn->error]);
}
?>
