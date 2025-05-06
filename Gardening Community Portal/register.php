<?php
session_start();

// When form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // secure hash
    $style = $_POST['style'];

    // Save user (for now in a file; you can later use database)
    $userData = "$username|$email|$password|$style\n";
    file_put_contents('users.txt', $userData, FILE_APPEND);

    // Send welcome email
    mail($email, "Welcome to Gardening Community!", "Hello $username,\n\nWelcome to our Gardening Community! Enjoy $style gardening with us.", "From: admin@gardeningportal.com");

    // Set cookie to remember username
    setcookie('remember_user', $username, time() + (86400 * 30)); // 30 days

    echo "Registration successful! <a href='login.php'>Login Now</a>";
    exit;
}
?>

<h2>Gardening Community Registration</h2>
<form method="post">
    Username: <input type="text" name="username" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    Preferred Gardening Style:
    <select name="style" required>
        <option value="Organic">Organic</option>
        <option value="Indoor">Indoor</option>
        <option value="Urban">Urban</option>
        <option value="Hydroponic">Hydroponic</option>
    </select><br><br>
    <input type="submit" value="Register">
</form>
