<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Directory to save uploaded files
    $targetDirectory = "uploads/";
    
    // Create uploads folder if it doesn't exist
    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }
    
    $file = $_FILES['portfolio_picture'];
    
    // Get file details
    $fileName = basename($file['name']);
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
    $allowedTypes = ['jpg', 'jpeg', 'png'];
    
    // Validate file type
    if (!in_array($fileType, $allowedTypes)) {
        echo "Error: Only JPG, JPEG, and PNG files are allowed.";
    }
    // Validate file size (2MB max)
    elseif ($fileSize > 2 * 1024 * 1024) {
        echo "Error: File size must be less than 2MB.";
    }
    else {
        // Create a unique file name to prevent overwriting
        $newFileName = uniqid('portfolio_', true) . '.' . $fileType;
        $targetFilePath = $targetDirectory . $newFileName;
        
        if (move_uploaded_file($fileTmpName, $targetFilePath)) {
            echo "Success! File uploaded successfully.<br>";
            echo "<img src='$targetFilePath' alt='Uploaded Portfolio Picture' width='300'>";
        } else {
            echo "Error: Failed to upload the file.";
        }
    }
}
?>

<!-- HTML Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Portfolio Picture</title>
</head>
<body>
    <h2>Portfolio Picture Upload</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label>Select an image (JPG, JPEG, PNG | Max 2MB):</label><br><br>
        <input type="file" name="portfolio_picture" required><br><br>
        <input type="submit" value="Upload">
    </form>
</body>
</html>
