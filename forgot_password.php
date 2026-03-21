<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - CHAN Tech</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <!-- Background Video -->
    <video class="bg-video" autoplay muted loop playsinline>
        <source src="dark_plexus.mp4" type="video/mp4">
    </video>   
    <div class="video-overlay"></div>
    
    <div class="contact-container" style="max-width: 500px;">

        <div style="text-align: center; margin-bottom: 30px;">
            <div class="logo-container" style="justify-content: center; margin-bottom: 10px;">
                <img src="Song_of_the_Welkin_Moon_Chapter.png" alt="CHAN Tech Logo" style="width: 50px; height: 50px;">
                <span class="logo-text highlight" style="font-size: 24px;">CHAN Tech</span>
            </div>
            
            <h2 style="font-family: var(--font-heading); font-size: 28px; color: var(--text-muted); font-weight: bold; margin: 0;">Forgot Your Password?</h2>
        </div>

        <?php if (isset($_SESSION['forgot_success'])): ?>
            <div class="success-message" >
                <?php echo htmlspecialchars($_SESSION['forgot_success']); unset($_SESSION['forgot_success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['forgot_error'])): ?>
            <div class="server-alert">
                <?php echo htmlspecialchars($_SESSION['forgot_error']); unset($_SESSION['forgot_error']); ?>
            </div>
        <?php endif; ?>

        <form action="process_forgot.php" method="POST">
            <div class="form-group full-width">
                <label for="email">Email Address <span class="required">*</span></label>
                <input type="email" id="email" name="user_email" placeholder="Enter your email" required>
            </div>
            <button type="submit" class="btn btn-primary full-width-btn" style="margin-top: 20px;">Send Reset Link</button>
        </form>

        <p class="text-home" style="margin-top: 10px; font-size: 13px;">
            <a href="login.php" style="color: var(--text-muted);">&#8592; Back to Log In</a>
        </p>
    </div>
</body>
</html>