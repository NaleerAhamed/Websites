<?php
// Database credentials
$db_host = 'localhost';   // Your database host (usually 'localhost')
$db_user = 'root';        // Your database username
$db_pass = '';            // Your database password
$db_name = 'mydb_97';     // Your database name

// Establishing a connection
$con = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    //die("Connection successful");
}
?>
