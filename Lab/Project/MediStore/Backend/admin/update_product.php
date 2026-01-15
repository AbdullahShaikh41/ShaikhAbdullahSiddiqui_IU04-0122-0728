<?php
include 'db_connect.php';

$id          = $_POST['id'] ?? 0;
$name        = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price       = $_POST['price'] ?? 0;
$qty         = $_POST['qty'] ?? 0;
$category    = $_POST['category'] ?? '';

$imageSql = "";
if (!empty($_FILES['image']['name'])) {
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    $image = time() . "_" . basename($_FILES['image']['name']);
    $targetFile = $targetDir . $image;
    move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
    $imageSql = ", image='$image'";
}

$query = "UPDATE products 
          SET name='$name',
              description='$description',
              price='$price',
              qty='$qty',
              category='$category'
              $imageSql
          WHERE id=$id";

if (mysqli_query($conn, $query)) {
    echo json_encode(["msg" => "Product updated successfully", "success" => true]);
} else {
    echo json_encode(["msg" => "Update failed", "success" => false]);
}
?>
