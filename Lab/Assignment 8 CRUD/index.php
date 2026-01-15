<?php
$conn = mysqli_connect('localhost', 'root', '', 'wpl');
$query = "select * from products";
$result = mysqli_query($conn, $query);

$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
</head>
<body>
<a href="form.php" class="btn btn-primary" style="margin:10px;">Create</a>
<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>Sr</th>
            <th>Product Category</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Product Quantity</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php for ($i = 0; $i < count($data); $i++) { ?>
        <tr>
            <td><?php echo $data[$i]['id'] ?></td>
            <td><?php echo $data[$i]['product_category'] ?></td>
            <td><?php echo $data[$i]['product_name'] ?></td>
            <td><?php echo $data[$i]['product_price'] ?></td>
            <td><?php echo $data[$i]['product_quantity'] ?></td>
            <td>
                <a href="edit.php?product_id=<?php echo $data[$i]['id'] ?>">Edit</a>
                <a href="delete.php?product_id=<?php echo $data[$i]['id'] ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</body>
</html>
