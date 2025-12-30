<?php
$id = $_GET['product_id'];

$conn = mysqli_connect('localhost', 'root', '', 'wpl');
$query = "delete from products where id = '$id' ";
$result = mysqli_query($conn, $query);

header('Location: '.'index.php');