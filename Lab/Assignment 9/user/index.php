<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediStore - Trusted Medicine Online</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css"> 
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #0d6efd;">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="index.php">
                <i class="fas fa-pills me-2"></i> MediStore
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Shop All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Health Articles</a>
                    </li> -->
                    <li class="nav-item me-2">
                        <a href="login.php" class="btn btn-light btn-sm mt-1 mt-lg-0">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="signup.php" class="btn btn-success btn-sm mt-1 mt-lg-0">Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <header class="py-5" style="background-color: #f2f6fc;">
        <div class="container">
            <div class="row align-items-center">
                
                <div class="col-lg-6 text-center text-lg-start mb-4 mb-lg-0">
                    <h1 class="display-4 fw-bold mb-3 page-title">Your Health, Our Priority</h1>
                    <p class="lead mb-4 text-muted">Reliable pharmacy products, delivered right to your door. Order now and access the best prices.</p>
                    
                    <a href="user_dashboard.php" class="btn btn-main btn-lg me-3">Order Medicine Now</a>
                    
                    <a href="#" class="btn btn-outline-primary btn-lg" style="border-color: #0d6efd; color: #0d6efd;">Explore Services</a>
                </div>

            </div>
        </div>
    </header>

    <section class="container my-5">
        <h2 class="text-center mb-5 page-title">Why Choose MediStore?</h2>
        
        <div class="row text-center">
            
            <div class="col-md-4 mb-4">
                <div class="custom-card h-100">
                    <i class="fas fa-truck fa-3x mb-3" style="color: #0d6efd;"></i>
                    <h5>Fast Delivery</h5>
                    <p class="text-muted">Your medications are delivered quickly and safely to your doorstep.</p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="custom-card h-100">
                    <i class="fas fa-shield-alt fa-3x mb-3" style="color: #0d6efd;"></i>
                    <h5>100% Genuine Medicine</h5>
                    <p class="text-muted">We only provide certified and authentic pharmacy products.</p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="custom-card h-100">
                    <i class="fas fa-headset fa-3x mb-3" style="color: #0d6efd;"></i>
                    <h5>24/7 Customer Support</h5>
                    <p class="text-muted">Our customer service team is always available for any questions.</p>
                </div>
            </div>
            
        </div>
    </section>

    <footer class="py-4 mt-5 text-white" style="background-color: #0a58ca;">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 MediStore. All Rights Reserved.</p>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>

</html>