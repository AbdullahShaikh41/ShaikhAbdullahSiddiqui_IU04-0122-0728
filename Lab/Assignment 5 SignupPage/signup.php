<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Instagram Sign Up</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: #fafafa;
      font-family: Arial, Helvetica, sans-serif;
    }
    .signup-box {
      max-width: 380px;
      border: 1px solid #dbdbdb;
      border-radius: 8px;
      background: #fff;
    }
    .insta-title {
      font-family: 'Segoe UI', cursive;
      font-size: 48px;
      font-weight: bold;
    }
    .form-control {
      background: #fafafa;
      font-size: 14px;
    }
    .btn-insta {
      background: #0095f6;
      color: white;
      font-weight: 600;
    }
    .btn-insta:hover {
      background: #0077cc;
      color: white;
    }
  </style>
</head>

<body>

<form method="POST" action="form.php" onsubmit="return validateForm()">

  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="signup-box p-4 text-center">

      <h1 class="insta-title mb-3">Instagram</h1>

      <p class="text-muted small">
        Sign up to see photos and videos from your friends.
      </p>

      <input type="text" class="form-control mt-2" id="name" name="name" placeholder="First name">
      <input type="text" class="form-control mt-2" id="surname" name="surname" placeholder="Surname">
      <input type="email" class="form-control mt-2" id="email" name="email" placeholder="Email address">
      <input type="password" class="form-control mt-2" id="password" name="password" placeholder="Password">

      <button class="btn btn-insta w-100 mt-3">Sign Up</button>

      <p class="small text-muted mt-3">
        By signing up, you agree to our Terms & Privacy Policy.
      </p>

    </div>
  </div>

</form>

<script>
function validateForm() {

    var name = document.getElementById("name").value.trim();
    var surname = document.getElementById("surname").value.trim();
    var email = document.getElementById("email").value.trim();
    var pass = document.getElementById("password").value.trim();

    if (name === "" || surname === "" || email === "" || pass === "") {
        alert("All fields are required");
        return false;
    }

    var nameRegex = /^[A-Za-z]+$/;
    if (!nameRegex.test(name) || !nameRegex.test(surname)) {
        alert("Name must contain only letters");
        return false;
    }

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Invalid email format");
        return false;
    }

    if (pass.length < 6) {
        alert("Password must be at least 6 characters");
        return false;
    }

    return true;
}
</script>

</body>
</html>



<?php
$conn = mysqli_connect("localhost", "root", "", "php_practice");

$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO form (name, surname, email, password)
        VALUES ('$name', '$surname', '$email', '$password')";

mysqli_query($conn, $sql);

echo "Signup Successful";

mysqli_close($conn);
?>

