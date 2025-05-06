<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

echo "<h2>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</h2>";
echo "<p>You have successfully logged in to the Gardening Community Portal.</p>";
?>

<a href="logout.php">Logout</a>
