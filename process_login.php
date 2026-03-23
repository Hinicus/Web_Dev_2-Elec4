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


$sql = "SELECT F_Name, Password FROM signup WHERE Email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
   
    if ($password === $row['Password']) {
        
        
        session_regenerate_id(true); 
        
        
        $_SESSION['user_name'] = $row['F_Name'];
        
        header("Location: index.php");
        exit();
    } else {
        
        $_SESSION['login_error'] = "Invalid email or password.";
    }
} else {
    $_SESSION['login_error'] = "Invalid email or password."; 
}

mysqli_stmt_close($stmt);
header("Location: login.php");
exit();
?>