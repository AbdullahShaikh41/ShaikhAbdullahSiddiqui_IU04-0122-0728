<?php
$id = $_GET['product_id'];

$conn = mysqli_connect('localhost', 'root', '', 'wpl');
$query = "select * from products where id = '$id' ";
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
  <div class="container">
    <form method="post" action="editFormSubmit.php">
      <div class="form-group" style="margin: 10px;">
        <input value="<?php echo $data[0]['id']?>" type="hidden" class="form-control" name="product_id">
      </div>
      <div class="form-group" style="margin: 10px;">
        <label>Product Name</label>
        <input value="<?php echo $data[0]['product_name']?>" type="text" class="form-control" name="product_name">
      </div>
      <div class="form-group" style="margin: 10px;">
        <label>Product Category</label>
        <input value="<?php echo $data[0]['product_category']?>" type="text" class="form-control" name="product_category">
      </div>
      <div class="form-group" style="margin: 10px;">
        <label>Product Price</label>
        <input value="<?php echo $data[0]['product_price']?>" type="number" class="form-control" name="product_price">
      </div>
      <div class="form-group" style="margin: 10px;">
        <label>Product Quantity</label>
        <input value="<?php echo $data[0]['product_quantity']?>" type="number" class="form-control" name="product_quantity">
      </div>
      <input type="submit" class="btn btn-primary" style="margin: 10px;" value="Submit">
    </form>
  </div>
</body>
</html>
