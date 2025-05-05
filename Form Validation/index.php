<!DOCTYPE html>
<html>
<head>
    <title>Form Validation in PHP</title>
    <style>
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>

<?php
// Define variables and set to empty
$name = $email = $password = $phone = "";
$nameErr = $emailErr = $passwordErr = $phoneErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Name validation
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = trim($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and spaces allowed";
        }
    }

    // Email validation
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = trim($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Password validation
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = trim($_POST["password"]);
        if (strlen($password) < 6) {
            $passwordErr = "Password must be at least 6 characters long";
        }
    }

    // Phone validation
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone number is required";
    } else {
        $phone = trim($_POST["phone"]);
        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $phoneErr = "Phone number must be exactly 10 digits";
        }
    }
}
?>

<h2>PHP Form Validation Example</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    Name: <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
    <span class="error">* <?php echo $nameErr; ?></span>
    <br><br>

    Email: <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
    <span class="error">* <?php echo $emailErr; ?></span>
    <br><br>

    Password: <input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
    <span class="error">* <?php echo $passwordErr; ?></span>
    <br><br>

    Phone Number: <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
    <span class="error">* <?php echo $phoneErr; ?></span>
    <br><br>

    <input type="submit" name="submit" value="Submit">  
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($phoneErr)) {
    echo "<h3 class='success'>Form submitted successfully!</h3>";
    echo "<h4>Your Input:</h4>";
    echo "Name: " . htmlspecialchars($name) . "<br>";
    echo "Email: " . htmlspecialchars($email) . "<br>";
    echo "Password: " . htmlspecialchars($password) . "<br>";
    echo "Phone: " . htmlspecialchars($phone) . "<br>";
}
?>

</body>
</html>
