<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Input Validation Form</title>
</head>
<body>
    <h2>User Input Form</h2>
    <form method="POST" action="">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="age">Age:</label><br>
        <input type="text" id="age" name="age" required><br><br>

        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" required><br><br>

        <label for="website">Website URL:</label><br>
        <input type="text" id="website" name="website" required><br><br>

        <input type="submit" value="Submit">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect and sanitize inputs
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $website = filter_input(INPUT_POST, 'website', FILTER_SANITIZE_URL);

        // Validate inputs
        $errors = [];

        if (empty($name)) {
            $errors[] = "Name is required.";
        }

        if (!filter_var($age, FILTER_VALIDATE_INT) || $age <= 0) {
            $errors[] = "Valid age is required.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Valid email is required.";
        }

        if (!filter_var($website, FILTER_VALIDATE_URL)) {
            $errors[] = "Valid website URL is required.";
        }

        if (empty($errors)) {
            echo "<h3>Form Submitted Successfully!</h3>";
            echo "Name: " . htmlspecialchars($name) . "<br>";
            echo "Age: " . htmlspecialchars($age) . "<br>";
            echo "Email: " . htmlspecialchars($email) . "<br>";
            echo "Website: " . htmlspecialchars($website) . "<br>";
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
