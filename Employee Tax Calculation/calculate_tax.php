<?php
// calculate_tax.php

// Include the file that holds the employee array
require('employee.php');

// Function to calculate total tax
function calculateTotalTax($employees) {
    $totalTax = 0;
    foreach ($employees as $employee) {
        $taxAmount = ($employee['salary'] * $employee['tax_percentage']) / 100;
        $totalTax += $taxAmount;
    }
    return $totalTax;
}

// Calculate and display total tax
$totalTax = calculateTotalTax($employees);

echo "Total tax to be paid by all employees: $" . $totalTax;
?>
