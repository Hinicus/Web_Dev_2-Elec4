<?php
session_start();
require 'connect.php'; // Ensure this has $conn = new mysqli(...)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitize input
    $email = trim($_POST['user_email']);
    $password = $_POST['user_password'];
    $confirm = $_POST['confirm_password'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['reset_error'] = "Invalid email address.";
        header("Location: forgot_password.php");
        exit();
    }

    // Validate password length
    if (strlen($password) < 8) {
        $_SESSION['reset_error'] = "Password must be at least 8 characters.";
        header("Location: forgot_password.php");
        exit();
    }

    // Check password confirmation
    if ($password !== $confirm) {
        $_SESSION['reset_error'] = "Passwords do not match.";
        header("Location: forgot_password.php");
        exit();
    }

    // Check if email exists and get current password
    $stmt = $conn->prepare("SELECT id, password FROM signup WHERE email = ?");
    if (!$stmt) {
        $_SESSION['reset_error'] = "Database error (prepare failed).";
        header("Location: forgot_password.php");
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        $_SESSION['reset_error'] = "No account found with that email.";
        $stmt->close();
        header("Location: forgot_password.php");
        exit();
    }

    $stmt->bind_result($user_id, $current_password);
    $stmt->fetch();
    $stmt->close();

    // Check if new password is same as old
    if ($password === $current_password) {
        $_SESSION['reset_error'] = "This is your old password. Please choose a new one.";
        header("Location: forgot_password.php");
        exit();
    }

    // Update the password (plain text)
    $stmt_update = $conn->prepare("UPDATE signup SET password = ? WHERE id = ?");
    if (!$stmt_update) {
        $_SESSION['reset_error'] = "Database error (prepare failed).";
        header("Location: forgot_password.php");
        exit();
    }

    $stmt_update->bind_param("si", $password, $user_id);

    if ($stmt_update->execute()) {
        $_SESSION['success'] = "Your password has been reset successfully.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['reset_error'] = "Failed to reset password. Please try again.";
    }

    $stmt_update->close();
    $conn->close();
}
?>