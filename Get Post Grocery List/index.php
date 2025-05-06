<?php
// Start session to store the grocery list between requests
session_start();

// Initialize grocery list if not already set
if (!isset($_SESSION['grocery_list'])) {
    $_SESSION['grocery_list'] = ['Apple', 'Banana', 'Carrot', 'Milk'];
}

// Handle adding a new item via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_item'])) {
    $newItem = trim($_POST['new_item']);
    if (!empty($newItem)) {
        $_SESSION['grocery_list'][] = ucfirst(strtolower($newItem)); // Clean input
    }
}

// Handle searching via GET
$searchResult = "";
if (isset($_GET['search_item'])) {
    $searchItem = trim($_GET['search_item']);
    if (!empty($searchItem)) {
        if (in_array(ucfirst(strtolower($searchItem)), $_SESSION['grocery_list'])) {
            $searchResult = "Item '<b>" . htmlspecialchars($searchItem) . "</b>' found in the grocery list.";
        } else {
            $searchResult = "Item '<b>" . htmlspecialchars($searchItem) . "</b>' NOT found in the grocery list.";
        }
    }
}
?>

<!-- HTML Part -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Grocery List Manager</title>
</head>
<body>

<h2>Grocery List Manager</h2>

<!-- Form to Add a New Item (POST) -->
<h3>Add New Item</h3>
<form method="post" action="">
    <input type="text" name="new_item" placeholder="Enter new item" required>
    <input type="submit" value="Add Item">
</form>

<!-- Form to Search for an Item (GET) -->
<h3>Search Item</h3>
<form method="get" action="">
    <input type="text" name="search_item" placeholder="Enter item to search" required>
    <input type="submit" value="Search">
</form>

<!-- Display Search Result -->
<?php if (!empty($searchResult)): ?>
    <p><?php echo $searchResult; ?></p>
<?php endif; ?>

<!-- Display Full Grocery List -->
<h3>Current Grocery List:</h3>
<ul>
    <?php foreach ($_SESSION['grocery_list'] as $item): ?>
        <li><?php echo htmlspecialchars($item); ?></li>
    <?php endforeach; ?>
</ul>

</body>
</html>
