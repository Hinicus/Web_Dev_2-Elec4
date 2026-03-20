<?php
session_start();
require_once 'connect.php'; 

$firstname = trim($_POST['user_name'] ?? '');
$lastname  = trim($_POST['user_lastname'] ?? '');
$email     = trim($_POST['user_email'] ?? '');
$password  = $_POST['user_password'] ?? '';
$confirm   = $_POST['confirm_password'] ?? '';

$errors = [];


if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
    $errors[] = "All fields are required.";
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}
if ($password !== $confirm) {
    $errors[] = "Passwords do not match.";
}
$passwordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{8,}$/';
if (!preg_match($passwordRegex, $password)) {
    $errors[] = "Password must be at least 8 characters and include at least one uppercase letter, one lowercase letter, one number, and one special character.";
}


$check_sql = "SELECT Email FROM signup WHERE Email = ?";
$check_stmt = mysqli_prepare($conn, $check_sql);
mysqli_stmt_bind_param($check_stmt, "s", $email);
mysqli_stmt_execute($check_stmt);
mysqli_stmt_store_result($check_stmt);

if (mysqli_stmt_num_rows($check_stmt) > 0) {
    $errors[] = "This email is already registered. Please log in.";
}
mysqli_stmt_close($check_stmt);


if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: sign-up.php");
    exit();
}


$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO signup (F_Name, L_Name, Email, Password) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $email, $hashed_password);

if (mysqli_stmt_execute($stmt)) {
    
    $_SESSION['success'] = "Account created successfully! You can now log in.";
    header("Location: login.php"); 
} else {
    $_SESSION['errors'] = ["Registration failed due to a system error."];
    header("Location: sign-up.php");
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
exit();
?>