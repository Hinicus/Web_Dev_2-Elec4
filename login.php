<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - CHAN Tech</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-form.css">
</head>

<body>
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
            
            <h2 style="font-family: var(--font-heading); font-size: 28px; color: var(--text-muted); font-weight: bold; margin: 0;">Log In to Your Account</h2>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="success-message" >
                <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['login_error'])): ?>
            <div class="error-message" style="background: rgba(255, 0, 0, 0.1); border: 1px solid #f44336; padding: 10px; margin-bottom: 20px; border-radius: 5px; color: #f44336; text-align: center; font-family: var(--font-body);">
                <?php echo htmlspecialchars($_SESSION['login_error']); unset($_SESSION['login_error']); ?>
            </div>
        <?php endif; ?>
        
        <form action="process_login.php" method="POST">
            
            <div class="form-group full-width">
                <label for="email">Email Address <span class="required">*</span></label>
                <input type="email" id="email" name="user_email" placeholder="Enter your email" required>
            </div>

            <div class="form-group full-width">
                <label for="password">Password <span class="required">*</span></label>
                <input type="password" id="password" name="user_password" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="btn btn-primary full-width-btn" style="margin-top: 20px;">Log In</button>
        </form>
        
        <p class="text-home">
            <span style="color: var(--text-muted);">Don't have an account?</span> 
            <br>
            <a href="sign-up.php" style="font-weight: bold; margin-top: 5px; display: inline-block;">Sign Up Here</a>
        </p>
        <p class="text-home" style="margin-top: 10px; font-size: 13px;">
            <a href="index.php" style="color: var(--text-muted);">&#8592; Back to Home</a>
        </p>
    </div>
</body>
</html>