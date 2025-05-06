<?php
// Function to calculate grade based on average
function calculateGrade($average) {
    if ($average >= 90) {
        return 'A';
    } elseif ($average >= 80) {
        return 'B';
    } elseif ($average >= 70) {
        return 'C';
    } elseif ($average >= 60) {
        return 'D';
    } else {
        return 'F';
    }
}

// Array to hold all student data
$students = [];

// Number of students to input (you can also make it dynamic)
echo "Enter the number of students: ";
$numberOfStudents = trim(fgets(STDIN));

// Input each student's data
for ($i = 0; $i < $numberOfStudents; $i++) {
    echo "\nEnter details for student " . ($i + 1) . ":\n";

    echo "Name: ";
    $name = trim(fgets(STDIN));

    // You can define subjects here
    $subjects = ['Math', 'Science', 'English'];
    $scores = [];

    foreach ($subjects as $subject) {
        echo "Enter marks for $subject: ";
        $score = (int)trim(fgets(STDIN));
        $scores[$subject] = $score;
    }

    $totalMarks = array_sum($scores);
    $average = $totalMarks / count($scores);
    $grade = calculateGrade($average);

    // Store in students array
    $students[] = [
        'name' => $name,
        'scores' => $scores,
        'total' => $totalMarks,
        'average' => $average,
        'grade' => $grade
    ];
}

// Display all students' information
echo "\n--- Student Performance Report ---\n";

foreach ($students as $student) {
    echo "Name: " . $student['name'] . "\n";
    echo "Scores:\n";
    foreach ($student['scores'] as $subject => $score) {
        echo "  $subject: $score\n";
    }
    echo "Total Marks: " . $student['total'] . "\n";
    echo "Average Marks: " . number_format($student['average'], 2) . "\n";
    echo "Grade: " . $student['grade'] . "\n";
    echo "----------------------------------\n";
}
?>
