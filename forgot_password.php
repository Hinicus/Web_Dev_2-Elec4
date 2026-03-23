<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - CHAN Tech</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
            
            <h2 style="font-family: var(--font-heading); font-size: 28px; color: var(--text-muted); font-weight: bold; margin: 0;">Reset Your Password</h2>
        </div>

        
        <?php if (isset($_SESSION['reset_error'])): ?>
            <div class="server-alert">
                <?php echo htmlspecialchars($_SESSION['reset_error']); unset($_SESSION['reset_error']); ?>
            </div>
        <?php endif; ?>

        <form action="process_forgot.php" method="POST" id="resetForm">

   
   <div class="form-group full-width">
            <label for="email">Email Address <span class="required">*</span></label>
            <div class="input-wrapper">
            <input type="text" id="email" name="user_email" placeholder="Enter your email">
            <span class="clear-btn" id="clearEmailBtn" title="Clear">&times;</span>
            </div>
            <div class="error-message" id="emailError">
            <span class="error-icon">!</span>
            <span>Email is required</span>
            </div>
            </div>

        <div class="form-group full-width">
            <label for="password">Password <span class="required">*</span></label>
            <div class="input-wrapper" style="position: relative;">
            <input type="password" id="password" name="user_password" placeholder="Create a password" />
           <i class="fas fa-eye toggle-eye" id="togglePassword" title="Show/Hide Password"></i>
           </div>
      <div class="error-message" id="passwordError">
      <span class="error-icon">!</span>
        <span>Password is required</span>
      </div>
    </div>

<div class="form-group full-width">
  <label for="confirmpass">Confirm Password <span class="required">*</span></label>
  <div class="input-wrapper" style="position: relative;">
    <input type="password" id="confirmpass" name="confirm_password" placeholder="Confirm your password" />

   
    <i class="fas fa-eye toggle-eye" id="toggleConfirmPassword" title="Show/Hide Password"></i>
  </div>
  <div class="error-message" id="confirmError">
    <span class="error-icon">!</span>
    <span>Passwords do not match</span>
  </div>
</div>

    <button type="submit" class="btn btn-primary full-width-btn" style="margin-top: 20px;">Reset Password</button>
</form>

        <p class="text-home" style="margin-top: 10px; font-size: 13px;">
            <a href="login.php" style="color: var(--text-muted);">&#8592; Back to Log In</a>
        </p>
    </div>

    <script>
const fields = [
  {
    input: document.getElementById('email'),
    error: document.getElementById('emailError'),
    clearBtn: document.getElementById('clearEmailBtn'), 
    validate: val => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val),
    emptyMsg: 'Email is required',
    invalidMsg: 'Invalid email address'
  },
  {
    input: document.getElementById('password'),
    error: document.getElementById('passwordError'),
    validate: val => /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{8,}$/.test(val),
    emptyMsg: 'Password is required',
    invalidMsg: 'Must be 8+ chars with an upper, lower, number & special character.',
    toggle: document.getElementById('togglePassword')
  },
  {
    input: document.getElementById('confirmpass'),
    error: document.getElementById('confirmError'),
    validate: val => val === document.getElementById('password').value,
    emptyMsg: 'Confirm password is required',
    invalidMsg: 'Passwords do not match',
    toggle: document.getElementById('toggleConfirmPassword')
  }
];


fields.forEach(field => {
  if (field.toggle) {
    field.toggle.addEventListener('click', () => {
      const type = field.input.type === 'password' ? 'text' : 'password';
      field.input.type = type;
      field.toggle.classList.toggle('fa-eye');
      field.toggle.classList.toggle('fa-eye-slash');
    });
  }
});


function showError(input, errorElem, msg) {
  input.classList.add('error');
  errorElem.style.display = 'flex';
  errorElem.querySelector('span:last-child').textContent = msg;
}

function hideError(input, errorElem) {
  input.classList.remove('error');
  errorElem.style.display = 'none';
}


fields.forEach(({ input, error, clearBtn, validate, emptyMsg, invalidMsg }) => {
  input.addEventListener('input', () => {
    const val = input.value.trim();

    
    if (clearBtn) {
      clearBtn.style.display = val ? 'block' : 'none';
    }

    if (!val) showError(input, error, emptyMsg);
    else if (!validate(val)) showError(input, error, invalidMsg);
    else hideError(input, error);
  });

  
  if (clearBtn) {
    clearBtn.addEventListener('click', () => {
      input.value = '';
      clearBtn.style.display = 'none';
      hideError(input, error);
      input.focus();
    });
  }
});


document.getElementById('password').addEventListener('input', () => {
  const confirmInput = document.getElementById('confirmpass');
  const confirmError = document.getElementById('confirmError');

  if (confirmInput.value !== "") {
    if (confirmInput.value !== password.value) {
      showError(confirmInput, confirmError, "Passwords do not match");
    } else {
      hideError(confirmInput, confirmError);
    }
  }
});


document.getElementById('resetForm').addEventListener('submit', e => {
  let valid = true;

  fields.forEach(({ input, error, validate, emptyMsg, invalidMsg }) => {
    const val = input.value.trim();

    if (!val) {
      showError(input, error, emptyMsg);
      valid = false;
    } else if (!validate(val)) {
      showError(input, error, invalidMsg);
      valid = false;
    } else {
      hideError(input, error);
    }
  });

  if (!valid) e.preventDefault();
});
</script>
</body>
</html>