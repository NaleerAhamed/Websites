<?php
require 'Db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = trim($_POST['loginName']);
    $password = trim($_POST['loginPassword']);

    if (empty($usernameOrEmail) || empty($password)) {
        echo "Please fill in all fields.";
        exit;
    }

    // Prepare SQL statement
    $sql = "SELECT * FROM admin WHERE (Username = ? OR Email = ?)";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['Password'])) {
                echo "Login successful!";
                // Start a session and redirect the user as needed
                session_start();
                //$_SESSION['user_id'] = $user['id']; // Assuming 'id' is the user ID column
                // header("Location: dashboard.php"); // Redirect to another page
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No account found with that username or email.";
        }

        $stmt->close();
    } else {
        echo "Database query failed.";
    }

    $con->close();
} else {
    echo "Invalid request method.";
}
?>
