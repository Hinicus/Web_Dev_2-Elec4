<?php
session_start();
require 'signup_db.php'; // Include your DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['user_email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['forgot_error'] = "Invalid email address.";
        header("Location: forgot_password.php");
        exit();
    }

    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        $_SESSION['forgot_error'] = "No account found with that email.";
        header("Location: forgot_password.php");
        exit();
    }

    $stmt->bind_result($user_id);
    $stmt->fetch();

    // Generate reset token
    $token = bin2hex(random_bytes(50));
    $expires = date("Y-m-d H:i:s", strtotime('+1 hour'));

    // Save token in database
    $stmt = $conn->prepare("UPDATE users SET reset_token=?, token_expires=? WHERE id=?");
    $stmt->bind_param("ssi", $token, $expires, $user_id);
    $stmt->execute();

    // Send email
    $reset_link = "https://yourdomain.com/reset_password.php?token=$token";
    $subject = "Password Reset Request";
    $message = "Hi,\n\nTo reset your password, click the link below:\n$reset_link\n\nThis link will expire in 1 hour.";
    $headers = "From: no-reply@yourdomain.com";

    if (mail($email, $subject, $message, $headers)) {
        $_SESSION['forgot_success'] = "A reset link has been sent to your email.";
    } else {
        $_SESSION['forgot_error'] = "Failed to send email. Try again later.";
    }

    header("Location: forgot_password.php");
    exit();
}
?>