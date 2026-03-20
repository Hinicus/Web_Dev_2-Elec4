<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - CHAN Tech</title>
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
            
            <h2 style="font-family: var(--font-heading); font-size: 28px; color: var(--text-muted); font-weight: bold; margin: 0;">Create an account</h2>
        </div>
        
        <form action="process_signup.php" method="POST">
            
            <div class="form-group full-width">
                <label for="name">First Name <span class="required">*</span></label>
                <input type="text" id="name" name="user_name" placeholder="Enter your first name">
            </div>

            <div class="form-group full-width">
                <label for="lastname">Last Name <span class="required">*</span></label>
                <input type="text" id="lastname" name="user_lastname" placeholder="Enter your last name">
            </div>

            <div class="form-group full-width">
                <label for="email">Email Address <span class="required">*</span></label>
                <input type="text" id="email" name="user_email" placeholder="Enter your email">
            </div>

            <div class="form-group full-width">
                <label for="password">Password <span class="required">*</span></label>
                <input type="password" id="password" name="user_password" placeholder="Create a password">
            </div>

            <div class="form-group full-width">
                <label for="confirm_password">Confirm Password <span class="required">*</span></label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password">
            </div>

            <button type="submit" class="btn btn-primary full-width-btn" style="margin-top: 20px;">Create Account</button>
        </form>
        
        <p class="text-home">
            <span style="color: var(--text-muted);">Already have an account?</span> 
            <br>
            <a href="login.php" style="font-weight: bold; margin-top: 5px; display: inline-block;">Log In Here</a>
        </p>
        <p class="text-home" style="margin-top: 10px; font-size: 13px;">
            <a href="index.php" style="color: var(--text-muted);">&#8592; Back to Home</a>
        </p>
    </div>
</body>
</html>