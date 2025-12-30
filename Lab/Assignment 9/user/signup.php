<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>MediStore - Signup</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../css/style.css"> <style>
        .signup-container {
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
            <a href="login.php" class="btn btn-outline-light btn-sm">Login</a>
        </div>
    </nav>

    <div class="signup-container">
        
        <div class="col-md-5"> 
            
            <div class="auth-card">
                
                <div> 

                    <h3 class="text-center mb-4 page-title" style="color: #0a58ca;">Account Registration</h3>

                    <div class="text-center mb-4">
                        <button type="button" class="btn btn-primary" onclick="showUserForm()">User Signup</button>
                        
                        <button type="button" class="btn btn-primary" onclick="showAdminForm()">Admin Signup</button>
                    </div>

                    <form id="userForm" onsubmit="return submitform(event)"> <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your Full Name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="contact" placeholder="03XXXXXXXXX" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Create a password" required>
                        </div>

                        <button class="btn btn-dark w-100 mt-2">
                            Complete Registration
                        </button>
                        
                        <div class="text-center mt-3">
                            <small class="text-muted">Already have an account? <a href="login.php" style="color: #0d6efd; text-decoration: none;">Login here</a></small>
                        </div>

                    </form>

                    <form id="adminForm" onsubmit="return submitAdminform(event)" style="display:none;"> <div class="mb-3">
                            <label class="form-label">Admin Name</label>
                            <input type="text" class="form-control" id="admin_name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Admin Email</label>
                            <input type="email" class="form-control" id="admin_email" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Admin Password</label>
                            <input type="password" class="form-control" id="admin_password" required>
                        </div>

                        <button class="btn btn-dark w-100 mt-2">
                            Register as Admin
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

    <script>
    // Form switching logic (No change)
    function showAdminForm() {
        document.getElementById("userForm").style.display = "none";
        document.getElementById("adminForm").style.display = "block";
    }

    function showUserForm() {
        document.getElementById("adminForm").style.display = "none";
        document.getElementById("userForm").style.display = "block";
    }

    function submitform(event) {
        event.preventDefault(); 
        
        var name = document.getElementById("name").value.trim();
        var email = document.getElementById("email").value.trim().toLowerCase();
        var contact = document.getElementById("contact").value.trim();
        var password = document.getElementById("password").value;
        const role = "user";
        const address = "Not Updated"; 

        // Basic Validation (Your existing checks)
        if (name == "" || email == "" || contact == "" || password == "") {
            alert("Please fill in all fields.");
            return false;
        }
        var nameRegex = /^[A-Za-z ]+$/;
        if (!nameRegex.test(name)) {
            alert("Name should contain only letters");
            return false;
        }
        var emailRegex = /^[a-zA-Z0-9._]+@[a-zA-Z]+\.[a-zA-Z]{2,}$/;
        if (!emailRegex.test(email)) {
            alert("Enter a valid email");
            return false;
        }
        var contactRegex = /^[0-9]{11}$/;
        if (!contactRegex.test(contact)) {
            alert("Contact must be 11 digits");
            return false;
        }
        var passwordRegex = /^.{6,}$/;
        if (!passwordRegex.test(password)) {
            alert("Password must be at least 6 characters");
            return false;
        }
        
        const userData = { name, email, password, contact, role, address };

        fetch('../../Backend/user/signup.php', { 
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(userData) 
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`✅ Registration successful! Redirecting to login...`);
                document.getElementById("userForm").reset();
                window.location.href = "login.php";
            } else {
                alert(`❌ Registration failed: ${data.message}`);
            }
        })
        .catch(error => {
            console.error('Network Error:', error);
            alert('An unexpected network error occurred. Please ensure XAMPP is running and file paths are correct.');
        });
        
        return false; 
    }


    // =======================================================
    // --- UPDATED: ADMIN Registration Logic (API Integration) ---
    // =======================================================
    function submitAdminform(event) {
        event.preventDefault(); 
        
        var name = document.getElementById("admin_name").value.trim();
        var email = document.getElementById("admin_email").value.trim().toLowerCase();
        var password = document.getElementById("admin_password").value;
        const role = 'admin';

        // Validation (Existing checks)
        if (name == "" || email == "" || password == "") {
            alert("Please fill in all fields.");
            return false;
        }
        var nameRegex = /^[A-Za-z ]+$/;
        if (!nameRegex.test(name)) {
            alert("Admin name should contain only letters");
            return false;
        }
        var emailRegex = /^[a-zA-Z0-9._]+@[a-zA-Z]+\.[a-zA-Z]{2,}$/;
        if (!emailRegex.test(email)) {
            alert("Enter a valid admin email");
            return false;
        }
        var passwordRegex = /^.{6,}$/;
        if (!passwordRegex.test(password)) {
            alert("Password must be at least 6 characters");
            return false;
        }

        const adminData = { name, email, password, contact: '', role, address: 'N/A' };
        
        // --- FETCH API CALL TO PHP BACKEND ---
        fetch('../../Backend/user/signup.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(adminData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`✅ Admin registered! Redirecting to login...`);
                document.getElementById("adminForm").reset();
                window.location.href = "login.php";
            } else {
                alert(`❌ Admin registration failed: ${data.message}`);
            }
        })
        .catch(error => {
            console.error('Network Error:', error);
            alert('An unexpected network error occurred. Please ensure XAMPP is running and file paths are correct.');
        });

        return false; 
    }
    </script>

</body>

</html>