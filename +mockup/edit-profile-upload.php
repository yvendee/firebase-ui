<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $uploadDir = "new_download/";
    $uploadFile = $uploadDir . basename($_FILES["file"]["name"]);
    $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    // Check if file is a valid image
    $validTypes = array("jpg", "jpeg", "png", "gif");
    if (!in_array($fileType, $validTypes)) {
        echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
        exit;
    }

    // Check if file already exists
    if (file_exists($uploadFile)) {
        echo "Error: File already exists.";
        exit;
    }

    // Upload file
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadFile)) {
        echo "File uploaded successfully.";
    } else {
        echo "Error uploading file.";
    }
}
?>
