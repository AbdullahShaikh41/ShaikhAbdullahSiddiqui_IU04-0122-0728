<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "medistore_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die(json_encode(["msg" => "Database connection failed", "code" => 500]));
}
?>
