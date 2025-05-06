<?php
session_start();
session_destroy();
setcookie('remember_user', '', time() - 3600); // expire the remember me cookie
header('Location: login.php');
exit;
?>
