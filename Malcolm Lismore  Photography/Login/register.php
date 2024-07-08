<?php
include 'Db_connect.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['registerUsername'];
    $email = $_POST['registerEmail'];
    $password = $_POST['registerPassword'];
    $repeatPassword = $_POST['registerRepeatPassword'];

    if ($password !== $repeatPassword) {
        echo "Passwords do not match.";
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Ensure $conn is defined and not null
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and execute SQL statement
    $sql = "INSERT INTO admin (Username, Email, Password) VALUES (?, ?, ?)";
    $stmt = $con->prepare($sql);

    if (!$stmt) {
        echo "Error: " . $con->error;
    } else {
        $stmt->bind_param("sss", $username, $email, $hashedPassword);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $con->close();
}
?>
