<?php
session_start();

// Initialize contacts array if not already
if (!isset($_SESSION['contacts'])) {
    $_SESSION['contacts'] = [];
}

// Initialize variables
$name = $email = $phone = $address = "";
$edit_id = -1;

// Handle form submission (ADD or EDIT)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone']));
    $address = htmlspecialchars(trim($_POST['address']));

    if (isset($_POST['edit_id']) && $_POST['edit_id'] !== "") {
        // Editing an existing contact
        $edit_id = (int)$_POST['edit_id'];
        if (isset($_SESSION['contacts'][$edit_id])) {
            $_SESSION['contacts'][$edit_id] = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address
            ];
        }
    } else {
        // Adding new contact
        $_SESSION['contacts'][] = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address
        ];
    }

    // Redirect to avoid resubmission
    header("Location: contacts.php");
    exit();
}

// Handle editing: Prefill form
if (isset($_GET['edit_id'])) {
    $edit_id = (int)$_GET['edit_id'];
    if (isset($_SESSION['contacts'][$edit_id])) {
        $name = $_SESSION['contacts'][$edit_id]['name'];
        $email = $_SESSION['contacts'][$edit_id]['email'];
        $phone = $_SESSION['contacts'][$edit_id]['phone'];
        $address = $_SESSION['contacts'][$edit_id]['address'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Management System</title>
</head>
<body>
<h2>Contact Management System</h2>

<!-- Contact Form -->
<form method="post" action="contacts.php">
    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?php echo $name; ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?php echo $email; ?>" required><br><br>

    <label>Phone:</label><br>
    <input type="text" name="phone" value="<?php echo $phone; ?>" required><br><br>

    <label>Address:</label><br>
    <textarea name="address" required><?php echo $address; ?></textarea><br><br>

    <input type="submit" value="<?php echo ($edit_id != -1) ? 'Update Contact' : 'Add Contact'; ?>">
</form>

<hr>

<!-- Display Contacts -->
<h3>All Contacts</h3>

<?php if (!empty($_SESSION['contacts'])): ?>
<table border="1" cellpadding="10">
    <tr>
        <th>Sl.No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Action</th>
    </tr>
    <?php foreach ($_SESSION['contacts'] as $index => $contact): ?>
    <tr>
        <td><?php echo $index + 1; ?></td>
        <td><?php echo htmlspecialchars($contact['name']); ?></td>
        <td><?php echo htmlspecialchars($contact['email']); ?></td>
        <td><?php echo htmlspecialchars($contact['phone']); ?></td>
        <td><?php echo htmlspecialchars($contact['address']); ?></td>
        <td><a href="contacts.php?edit_id=<?php echo $index; ?>">Edit</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p>No contacts available.</p>
<?php endif; ?>

</body>
</html>
