<?php
session_start();
require 'connect.php'; // your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['user_email']);
    $password = $_POST['user_password'];
    $confirm = $_POST['confirm_password'];

    // Basic validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['reset_error'] = "Invalid email address.";
        header("Location: forgot_password.php");
        exit();
    }

    if (strlen($password) < 8) {
        $_SESSION['reset_error'] = "Password must be at least 6 characters.";
        header("Location: forgot_password.php");
        exit();
    }

    if ($password !== $confirm) {
        $_SESSION['reset_error'] = "Passwords do not match.";
        header("Location: forgot_password.php");
        exit();
    }

    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        $_SESSION['reset_error'] = "No account found with that email.";
        header("Location: forgot_password.php");
        exit();
    }

    $stmt->bind_result($user_id);
    $stmt->fetch();

    // Hash new password
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // Update password in DB
    $stmt_update = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt_update->bind_param("si", $hashed, $user_id);

    if ($stmt_update->execute()) {
        $_SESSION['reset_success'] = "Your password has been reset successfully.";
    } else {
        $_SESSION['reset_error'] = "Failed to reset password. Try again.";
    }

    header("Location: forgot_password.php");
    exit();
}
?>