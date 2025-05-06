<?php
session_start();

// Set timeout duration (in seconds)
$timeout_duration = 300; // 5 minutes

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Check for session timeout
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: login.php?timeout=1");
    exit();
}

// Update last activity time
$_SESSION['last_activity'] = time();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
<h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

<p><a href="logout.php">Logout</a></p>

</body>
</html>
