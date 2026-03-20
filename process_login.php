<?php
session_start();
require_once 'connect.php';

$email = trim($_POST['user_email'] ?? '');
$password = $_POST['user_password'] ?? '';

if (empty($email) || empty($password)) {
    $_SESSION['login_error'] = "Please fill in all fields.";
    header("Location: login.php");
    exit();
}

// Fetch the user data based on the email
$sql = "SELECT F_Name, Password FROM signup WHERE Email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    // Verify the typed password against the hashed password in the database
    if (password_verify($password, $row['Password'])) {
        
        // Security best practice: Regenerate session ID to prevent session fixation attacks
        session_regenerate_id(true); 
        
        // Set the session variable so index.php knows who is logged in
        $_SESSION['user_name'] = $row['F_Name'];
        
        header("Location: index.php");
        exit();
    } else {
        // Keep error generic to prevent attackers from guessing valid emails
        $_SESSION['login_error'] = "Invalid email or password.";
    }
} else {
    $_SESSION['login_error'] = "Invalid email or password."; 
}

mysqli_stmt_close($stmt);
header("Location: login.php");
exit();
?>