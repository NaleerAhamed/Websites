<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "mydb_97";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the file is uploaded
if (isset($_FILES["file"])) {
    // File details
    $imageName = $_POST["name"];
    $fileTmpName = $_FILES["file"]["tmp_name"];
    $fileName = $_FILES["file"]["name"];

    // Define upload directory
    $uploadDir = 'Upld/';

    // Move uploaded file to the specified directory
    if (move_uploaded_file($fileTmpName, $uploadDir . $fileName)) {
        // Prepare SQL to insert image details into database
        $sql = "INSERT INTO image (Imagename, Data) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $null = NULL;

        // Read the file content
        $fileData = file_get_contents($uploadDir . $fileName);

        // Bind parameters
        $stmt->bind_param("sb", $fileName, $null);
        $stmt->send_long_data(1, $fileData);

        // Execute the query
        if ($stmt->execute()) {
            echo "File uploaded and stored successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Failed to upload file.";
    }
} else {
    echo "No file uploaded.";
}

// Close the database connection
$conn->close();
?>
