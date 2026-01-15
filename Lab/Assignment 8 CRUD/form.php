<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <form method="post" action="formSubmit.php">
      <div class="form-group" style="margin: 10px;">
        <label>Product Name</label>
        <input type="text" class="form-control" name="product_name">
      </div>
      <div class="form-group" style="margin: 10px;">
        <label>Product Category</label>
        <input type="text" class="form-control" name="product_category">
      </div>
      <div class="form-group" style="margin: 10px;">
        <label>Product Price</label>
        <input type="number" class="form-control" name="product_price">
      </div>
      <div class="form-group" style="margin: 10px;">
        <label>Product Quantity</label>
        <input type="number" class="form-control" name="product_quantity">
      </div>
      <input type="submit" class="btn btn-primary" style="margin: 10px;" value="Submit">
    </form>
  </div>
</body>
</html>
