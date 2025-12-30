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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
</head>

<a href="form.php" class="btn btn-primary">Create</a>
<body>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <th>Sr</th>
            <th>Product Category</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Product Quantity</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < count($data); $i++) {
                ?>
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
            <?php
            }
            ?>
        </tbody>
    </table>
</body>

</html>