<?php
// Database connection
$servername = "localhost";
$username = "root"; // your DB username
$password = "";     // your DB password
$database = "your_database_name"; // replace with your database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1. Fetch staff from Sales department with salary > 4000
echo "<h2>Sales Staff with Salary > $4000 (Ordered by Salary)</h2>";

$sql = "SELECT * FROM staff 
        WHERE department = 'Sales' AND salary > 4000 
        ORDER BY salary ASC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Staff ID</th><th>Name</th><th>Department</th><th>Salary</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['staff_id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['department']}</td>
                <td>\${$row['salary']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No matching records found.";
}

// 2. Group by department and count number of employees
echo "<h2>Number of Employees in Each Department</h2>";

$sqlGroup = "SELECT department, COUNT(*) as num_employees
             FROM staff
             GROUP BY department";

$resultGroup = $conn->query($sqlGroup);

if ($resultGroup->num_rows > 0) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Department</th><th>Number of Employees</th></tr>";
    while ($row = $resultGroup->fetch_assoc()) {
        echo "<tr>
                <td>{$row['department']}</td>
                <td>{$row['num_employees']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No departments found.";
}

// Close connection
$conn->close();
?>
