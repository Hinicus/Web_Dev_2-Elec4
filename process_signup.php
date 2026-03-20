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

// First name
if (empty($firstname) || !preg_match("/^[a-zA-Z ]+$/", $firstname)) {
    $errors['firstname'] = "Only letters and spaces allowed";
}

// Last name
if (empty($lastname) || !preg_match("/^[a-zA-Z ]+$/", $lastname)) {
    $errors['lastname'] = "Only letters and spaces allowed";
}

// Email
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email format";
}

// Password
if (strlen($password) < 8) {
    $errors['password'] = "Password must be at least 8 characters";
}

// Confirm password
if ($confirm !== $password) {
    $errors['confirm'] = "Passwords do not match";
}

// 🚨 If may error → balik sa form
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;
    header("Location: sign-up.html"); // ⚠️ dapat PHP, hindi HTML
    exit();
}

// 🔐 Hash password (IMPORTANT)
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Escape inputs
$firstname = mysqli_real_escape_string($conn, $firstname);
$lastname  = mysqli_real_escape_string($conn, $lastname);
$email     = mysqli_real_escape_string($conn, $email);

// ✅ Insert query
$sql = "INSERT INTO signup (name, lastname, email, password)
        VALUES ('$firstname', '$lastname', '$email', '$hashedPassword')";

// 🚨 CHECK ERROR HERE
if (!mysqli_query($conn, $sql)) {
    die("Database Error: " . mysqli_error($conn));
}

// Success
$_SESSION['success'] = "Account created!";
header("Location: sign-up.html");
exit();
 ?>