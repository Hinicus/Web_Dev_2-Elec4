<?php
session_start(); // ✅ REQUIRED

$conn = mysqli_connect("localhost", "root", "", "signup_db");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get inputs safely
$firstname = $_POST['user_name'] ?? '';
$lastname  = $_POST['user_lastname'] ?? '';
$email     = $_POST['user_email'] ?? '';
$password  = $_POST['user_password'] ?? '';
$confirm   = $_POST['confirm_password'] ?? '';

$errors = [];

// 🚨 If may error → balik sa form
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;
    header("Location: sign-up.php");
    exit();
}

// Escape inputs
$firstname = mysqli_real_escape_string($conn, $firstname);
$lastname  = mysqli_real_escape_string($conn, $lastname);
$email     = mysqli_real_escape_string($conn, $email);

// ✅ Insert query
$sql = "INSERT INTO signup (F_Name, L_Name, Email, Password)
        VALUES ('$firstname', '$lastname', '$email', '$password')";

// 🚨 CHECK ERROR HERE
if (!mysqli_query($conn, $sql)) {
    die("Database Error: " . mysqli_error($conn));
}

// Success
$_SESSION['success'] = "Account created!";
header("Location: sign-up.php");
exit();
 ?>