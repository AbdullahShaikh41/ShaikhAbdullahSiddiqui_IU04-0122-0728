<?php
include 'db_connect.php';

$id = $_POST['id'] ?? 0;

$photo = "";
$res = mysqli_query($conn, "SELECT image FROM products WHERE id=$id");
if ($res && mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
    $photo = $row['image'];
}

$query = "DELETE FROM products WHERE id=$id";

if (mysqli_query($conn, $query)) {
    if ($photo && file_exists("uploads/" . $photo)) {
        unlink("uploads/" . $photo);
    }
    echo json_encode(["msg" => "Product deleted successfully", "success" => true]);
} else {
    echo json_encode(["msg" => "Delete failed", "success" => false]);
}
?>
