<?php
// Function that accepts array by value
function doubleValue(&$arr) {
    // Double each number in the array
    for ($i = 0; $i < count($arr); $i++) {
        $arr[$i] *= 2;
    }
    // Display the modified array inside the function
    echo "Array inside the function (after doubling): ";
    print_r($arr);
}

// Original array
$originalArray = [1, 2, 3, 4, 5];

// Call the function
doubleValue($originalArray);

// Display the original array after the function call
echo "Original array after function call: ";
print_r($originalArray);
?>
