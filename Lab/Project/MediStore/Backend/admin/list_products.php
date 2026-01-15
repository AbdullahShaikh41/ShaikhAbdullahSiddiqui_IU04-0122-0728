<?php
include 'db_connect.php';

$query = "SELECT * FROM products ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

echo json_encode(["success" => true, "data" => $products]);
?>
