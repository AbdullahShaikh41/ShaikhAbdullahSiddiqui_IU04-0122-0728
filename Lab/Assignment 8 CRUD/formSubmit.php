<?php
$conn = mysqli_connect('localhost', 'root', '', 'wpl');

$product_name = $_POST['product_name'];
$product_category = $_POST['product_category'];
$product_price = $_POST['product_price'];
$product_quantity = $_POST['product_quantity'];


$query = "INSERT INTO products(product_name,product_category,product_price,product_quantity) 
values('$product_name','$product_category','$product_price','$product_quantity')";
mysqli_query($conn, $query);
header('Location: '.'index.php');
