<?php
session_start();
session_unset();   // ✅ clears all session variables
session_destroy(); // ✅ ends the session
header("Location: ../../Frontend/user/login.php"); // ✅ redirect to login
exit;
?>
