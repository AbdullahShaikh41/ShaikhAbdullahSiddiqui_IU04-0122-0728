<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>MediStore - Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style.css"> <style>
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f2f6fc; 
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</head>

<body>

    <nav class="navbar navbar-dark shadow-sm py-2" style="background-color: #0d6efd;">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="../../index.php">
                <i class="fas fa-pills me-2"></i> MediStore
            </a>
            <a href="signup.php" class="btn btn-outline-light btn-sm">Sign Up</a>
        </div>
    </nav>


    <div class="login-container">
        
        <div class="auth-card">
            
            <h3 class="text-center mb-4 page-title" style="color: #0a58ca;">Login to MediStore</h3>

            <form onsubmit="return loginUser(event)"> <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" class="form-control" placeholder="Enter your password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
                
                <div class="text-center">
                    <small class="text-muted">Don't have an account? <a href="signup.php" style="color: #0d6efd; text-decoration: none;">Sign Up here</a></small>
                </div>

            </form>
        </div>
    </div>


    <script>
    function loginUser(event) { // ADDED (event)
        event.preventDefault(); 
        
        var email = document.getElementById("email").value.trim().toLowerCase();
        var password = document.getElementById("password").value;

        if (email == "") {
            alert("Email is required");
            return false;
        }

        if (password == "") {
            alert("Password is required");
            return false;
        }

        const loginData = { email, password };

        // --- FETCH API CALL TO PHP BACKEND (Path: user/ -> frontend/ -> backend/login.php) ---
        fetch('../../Backend/user/login.php', { 
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(loginData) 
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Login successful!
                alert(`Welcome, ${data.user.name}! You are logged in as ${data.user.role}.`);
                
                // User data ko Local Storage mein save karna
                localStorage.setItem('loggedInUser', JSON.stringify(data.user));
                
                // Redirection
                if (data.user.role === 'admin') {
                    // Assuming admin_dashboard.html is in frontend/admin/
                    window.location.href = "../admin/admin_dashboard.html"; 
                } else {
                    // Assuming user_dashboard.html is in frontend/user/
                    window.location.href = "user_dashboard.php"; 
                }

            } else {
                // Login failed (Invalid credentials)
                alert(`❌ Login Failed: ${data.message}`);
            }
        })
        .catch(error => {
            console.error('Network Error:', error);
            alert('An unexpected network error occurred. Please ensure XAMPP is running and file paths are correct.');
        });
        
        return false; 
    }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>