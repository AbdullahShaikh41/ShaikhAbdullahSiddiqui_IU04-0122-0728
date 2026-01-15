<?php
include 'db_connect.php';

$name        = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price       = $_POST['price'] ?? 0;
$qty         = $_POST['qty'] ?? 0;
$category    = $_POST['category'] ?? '';
$image       = "";

if (!empty($_FILES['image']['name'])) {
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    $image = time() . "_" . basename($_FILES['image']['name']);
    $targetFile = $targetDir . $image;
    move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
}

$query = "INSERT INTO products (name, description, price, qty, category, image, created_at)
          VALUES ('$name', '$description', '$price', '$qty', '$category', '$image', NOW())";

if (mysqli_query($conn, $query)) {
    echo json_encode(["msg" => "Product added successfully", "success" => true]);
} else {
    echo json_encode(["msg" => "Insert failed", "success" => false]);
}
?>
