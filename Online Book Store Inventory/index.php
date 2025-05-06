<!-- Step 1 -->

1. SQL: Create database and table

-- Create the database
CREATE DATABASE bookstoreDB;

-- Use the database
USE bookstoreDB;

-- Create the 'book' table
CREATE TABLE book (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200),
    author VARCHAR(100),
    price FLOAT,
    stock INT,
    published_year YEAR
);


<!-- Step 2 -->

2. SQL: Insert 5 book records (multi-row insert)

INSERT INTO book (title, author, price, stock, published_year) VALUES
('The Silent Patient', 'Alex Michaelides', 15.99, 10, 2019),
('Educated', 'Tara Westover', 13.50, 7, 2018),
('The Midnight Library', 'Matt Haig', 17.75, 5, 2020),
('Atomic Habits', 'James Clear', 16.20, 12, 2018),
('Becoming', 'Michelle Obama', 18.99, 8, 2019);


<!-- Step 3 -->

3. PHP Application: Connect, Fetch, Display
Now the PHP code:

<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = "";     // Your MySQL password (blank for default XAMPP)
$database = "bookstoreDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch books published after 2015, sorted by price descending
$sql = "SELECT * FROM book WHERE published_year > 2015 ORDER BY price DESC";
$result = $conn->query($sql);

echo "<h2>Books Published After 2015 (Sorted by Price Descending)</h2>";
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>
            <tr>
                <th>Book ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Price ($)</th>
                <th>Stock</th>
                <th>Published Year</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['book_id']}</td>
                <td>{$row['title']}</td>
                <td>{$row['author']}</td>
                <td>{$row['price']}</td>
                <td>{$row['stock']}</td>
                <td>{$row['published_year']}</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "No books found.";
}

// Find the most expensive book
$sql2 = "SELECT * FROM book ORDER BY price DESC LIMIT 1";
$result2 = $conn->query($sql2);

echo "<h2>Most Expensive Book</h2>";
if ($result2->num_rows > 0) {
    $row = $result2->fetch_assoc();
    echo "Title: " . $row['title'] . "<br>";
    echo "Author: " . $row['author'] . "<br>";
    echo "Price: $" . $row['price'] . "<br>";
    echo "Published Year: " . $row['published_year'] . "<br>";
} else {
    echo "No books found.";
}

// Close the connection
$conn->close();
?>


<!-- 

Summary of SQL Queries Used:
Fetch after 2015:

sql
Copy
Edit
SELECT * FROM book WHERE published_year > 2015 ORDER BY price DESC;
Find most expensive book:

sql
Copy
Edit
SELECT * FROM book ORDER BY price DESC LIMIT 1;

-->