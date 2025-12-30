<?php include("../session_check.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <title>MediStore - User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
  
</head>
<body>
<div class="sidebar">
  <h4 class="text-center mt-3">MediStore</h4>
  <hr class="text-white-50">
  <ul class="nav flex-column">
    <li class="nav-item mb-2"><a href="profile.php" class="nav-link"><i class="fas fa-user-circle me-2"></i> My Profile</a></li>
    <li class="nav-item mb-2"><a href="user_dashboard.php" class="nav-link active"><i class="fas fa-shopping-bag me-2"></i> All Products</a></li>
    <li class="nav-item mb-2"><a href="my_orders.php" class="nav-link"><i class="fas fa-history me-2"></i> My Orders</a></li>
    <li class="nav-item mb-2"><a href="cart.php" class="nav-link"><i class="fas fa-shopping-cart me-2"></i> My Cart (<span id="cartCount">0</span>)</a></li>
  </ul>
  <hr class="text-white-50 my-3">
  <h5 class="text-white mt-3">Shop by Category</h5>
  <ul class="nav flex-column category-list">
    <li class="nav-item"><a href="#" class="nav-link category-link active" data-category="All"><i class="fas fa-list me-2"></i> All Items</a></li>
    <li class="nav-item"><a href="#" class="nav-link category-link" data-category="Tablets"><i class="fas fa-pills me-2"></i> Tablets</a></li>
    <li class="nav-item"><a href="#" class="nav-link category-link" data-category="Suspensions"><i class="fas fa-tint me-2"></i> Suspensions</a></li>
    <li class="nav-item"><a href="#" class="nav-link category-link" data-category="Injections"><i class="fas fa-syringe me-2"></i> Injections</a></li>
    <li class="nav-item"><a href="#" class="nav-link category-link" data-category="Others"><i class="fas fa-box-open me-2"></i> Others</a></li>
  </ul>
  <a href="login.php" class="btn btn-danger w-100 logout-btn">
  <i class="fas fa-sign-out-alt me-2"></i> Logout
</a>

</div>

<div class="main-content-area">
  <h2 id="sectionTitle" class="page-title">User</h2>
  <hr>
  <div class="row" id="pageContent"><!-- Injected content here --></div>
</div>
</body>
</html>
