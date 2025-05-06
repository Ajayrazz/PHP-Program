<?php
// 1. Declare an array of integers
$numbers = [45, 12, 78, 4, 89, 23, 1, 90];

// 2. Find the minimum and maximum value
$minValue = min($numbers);
$maxValue = max($numbers);

// 3. Sort the array in ascending order
sort($numbers);

// Output the results
echo "Original Array: [45, 12, 78, 4, 89, 23, 1, 90]<br>";
echo "Minimum Value: $minValue<br>";
echo "Maximum Value: $maxValue<br>";
echo "Sorted Array (Ascending): " . implode(", ", $numbers) . "<br>";
?>


<?php
// Function to clean the string and check for palindrome
function isPalindrome($string) {
    // Remove non-alphanumeric characters and convert to lowercase
    $cleaned = strtolower(preg_replace("/[^A-Za-z0-9]/", "", $string));
    
    // Check if cleaned string is same as its reverse
    return $cleaned === strrev($cleaned);
}

// Ask user input (for CLI - command line interface PHP)
// For web-based, replace this with a form (if needed)
echo "Enter a string to check for palindrome: ";
$input = trim(fgets(STDIN));

// Check and output result
if (isPalindrome($input)) {
    echo "The string is a palindrome.\n";
} else {
    echo "The string is NOT a palindrome.\n";
}
?>
