<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration Form</title>
</head>
<body>
    <h2>User Registration Form</h2>

    <form method="POST" action="">
        <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>

        <input type="submit" value="Register">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = [];

        // Collect input and sanitize
        $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password']; // Passwords should not be sanitized directly
        $confirm_password = $_POST['confirm_password'];

        // Validation

        // 1. All fields filled
        if (empty($first_name)) {
            $errors[] = "First name is required.";
        }

        if (empty($last_name)) {
            $errors[] = "Last name is required.";
        }

        if (empty($email)) {
            $errors[] = "Email is required.";
        }

        if (empty($password)) {
            $errors[] = "Password is required.";
        }

        if (empty($confirm_password)) {
            $errors[] = "Confirm password is required.";
        }

        // 2. Email format
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        // 3. Password strength
        if (!empty($password)) {
            if (strlen($password) < 8) {
                $errors[] = "Password must be at least 8 characters long.";
            }
            if (!preg_match('/[A-Z]/', $password)) {
                $errors[] = "Password must contain at least one uppercase letter.";
            }
            if (!preg_match('/[0-9]/', $password)) {
                $errors[] = "Password must contain at least one number.";
            }
            if (!preg_match('/[\W]/', $password)) {
                $errors[] = "Password must contain at least one special character.";
            }
        }

        // 4. Password match
        if (!empty($password) && !empty($confirm_password) && $password !== $confirm_password) {
            $errors[] = "Password and Confirm Password do not match.";
        }

        // Result
        if (empty($errors)) {
            echo "<h3>Registration Successful!</h3>";
            echo "Welcome, " . htmlspecialchars($first_name) . " " . htmlspecialchars($last_name) . "!<br>";
            echo "Your email: " . htmlspecialchars($email);
        } else {
            echo "<h3>Errors:</h3><ul>";
            foreach ($errors as $error) {
                echo "<li>" . htmlspecialchars($error) . "</li>";
            }
            echo "</ul>";
        }
    }
    ?>
</body>
</html>
