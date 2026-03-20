<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "signup_db";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = mysqli_connect($host, $user, $password, $database);
    $conn->set_charset("utf8mb4"); 
} catch (Exception $e) {
    
    error_log($e->getMessage());
    die("Database connection error. Please try again later.");
}

?>