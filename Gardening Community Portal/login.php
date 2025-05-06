<?php
session_start();

if (!isset($_SESSION['failed_attempts'])) {
    $_SESSION['failed_attempts'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    // Check lockout
    if (isset($_SESSION['locked_until']) && time() < $_SESSION['locked_until']) {
        echo "Account locked due to multiple failed attempts. Please try again later.";
        exit;
    }

    $users = file('users.txt', FILE_IGNORE_NEW_LINES);

    $valid = false;
    foreach ($users as $user) {
        list($storedUsername, $storedEmail, $storedPassword, $storedStyle) = explode('|', $user);
        if ($storedUsername === $username && password_verify($password, $storedPassword)) {
            $valid = true;
            break;
        }
    }

    if ($valid) {
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;
        $_SESSION['failed_attempts'] = 0;

        if ($remember) {
            setcookie('remember_user', $username, time() + (86400 * 30)); // 30 days
        }

        header('Location: welcome.php');
        exit;
    } else {
        $_SESSION['failed_attempts']++;

        if ($_SESSION['failed_attempts'] >= 3) {
            $_SESSION['locked_until'] = time() + (15 * 60); // 15 minutes
            echo "Too many failed attempts. Account locked for 15 minutes.";
        } else {
            echo "Invalid credentials. Attempt {$_SESSION['failed_attempts']}/3.";
        }
    }
}
?>

<h2>Gardening Community Login</h2>
<form method="post">
    Username: <input type="text" name="username" value="<?php echo isset($_COOKIE['remember_user']) ? $_COOKIE['remember_user'] : ''; ?>" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    Remember Me: <input type="checkbox" name="remember"><br><br>
    <input type="submit" value="Login">
</form>
