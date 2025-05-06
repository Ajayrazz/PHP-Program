<?php
session_start();

// Dummy username and password
$valid_username = "admin";
$valid_password = "password123";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate credentials
    if ($username == $valid_username && $password == $valid_password) {
        $_SESSION['username'] = $username;
        $_SESSION['last_activity'] = time(); // Track last activity time
        header("Location: welcome.php");
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h2>Login Page</h2>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="post" action="">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <input type="submit" value="Login">
</form>

</body>
</html>
