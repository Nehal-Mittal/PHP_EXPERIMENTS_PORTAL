<?php
// db.php — centralized database connection file

// Define constants
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "Mish@0408");
define("DB_NAME", "php_lab");

// Create a MySQL connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>