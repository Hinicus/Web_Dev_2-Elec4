<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - CHAN Tech</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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
        
        <form id="signupForm" action="process_signup.php" method="POST">
            
            <div class="form-group full-width">
            <label for="name">First Name <span class="required">*</span></label>
            <div class="input-wrapper">
            <input type="text" id="name" name="user_name" placeholder="Enter your first name">
            <span class="clear-btn" id="clearNameBtn" title="Clear">&times;</span>
            </div>
            <div class="error-message" id="nameError">
                <span class="error-icon">!</span>
                <span>First name is required</span>
             </div>
            </div>

            <div class="form-group full-width">
            <label for="lastname">Last Name <span class="required">*</span></label>
            <div class="input-wrapper">
            <input type="text" id="lastname" name="user_lastname" placeholder="Enter your last name">
            <span class="clear-btn" id="clearLastnameBtn" title="Clear">&times;</span>
            </div>
            <div class="error-message" id="lastnameError">
            <span class="error-icon">!</span>
            <span>Last name is required</span>
            </div>
            </div>

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
          <div class="input-wrapper">
           <input type="password" id="password" name="user_password" placeholder="Create a password" />
          <span class="clear-btn" id="clearPasswordBtn" title="Clear">&times;</span>
          </div>
          <div class="error-message" id="passwordError">
          <span class="error-icon">!</span>
            <span>Password is required</span>
          </div>
          </div>

         <div class="form-group full-width">
          <label for="confirmpass">Confirm Password <span class="required">*</span></label>
         <div class="input-wrapper">
           <input type="password" id="confirmpass" name="confirm_password" placeholder="Confirm your password" />
           <span class="clear-btn" id="clearConfirmBtn" title="Clear">&times;</span>
         </div>
           <div class="error-message" id="confirmError">
            <span class="error-icon">!</span>
          <span>Passwords do not match</span>
       </div>
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

    <script>
  const fields = [
    {
      input: document.getElementById('name'),
      error: document.getElementById('nameError'),
      clearBtn: document.getElementById('clearNameBtn'),
      validate: val => /^[a-zA-Z ]+$/.test(val),
      emptyMsg: 'First name is required',
      invalidMsg: 'Only letters and spaces allowed'
    },
    {
      input: document.getElementById('lastname'),
      error: document.getElementById('lastnameError'),
      clearBtn: document.getElementById('clearLastnameBtn'),
      validate: val => /^[a-zA-Z ]+$/.test(val),
      emptyMsg: 'Last name is required',
      invalidMsg: 'Only letters and spaces allowed'
    },
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
      clearBtn: document.getElementById('clearPasswordBtn'),
      validate: val => val.length >= 8,
      emptyMsg: 'Password is required',
      invalidMsg: 'Password must be at least 8 characters'
    },
    {
      input: document.getElementById('confirmpass'),
      error: document.getElementById('confirmError'),
      clearBtn: document.getElementById('clearConfirmBtn'),
      validate: val => val === document.getElementById('password').value,
      emptyMsg: 'Confirm password is required',
      invalidMsg: 'Passwords do not match'
    },
  ];

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
      clearBtn.style.display = val ? 'block' : 'none';

      if (!val) {
        showError(input, error, emptyMsg);
      } else if (!validate(val)) {
        showError(input, error, invalidMsg);
      } else {
        hideError(input, error);
      }
    });

    clearBtn.addEventListener('click', () => {
      input.value = '';
      clearBtn.style.display = 'none';
      hideError(input, error);
      input.focus();
    });
  });

  // Prevent form submit if invalid
  document.getElementById('signupForm').addEventListener('submit', e => {
    let formValid = true;
    fields.forEach(({ input, error, validate, emptyMsg, invalidMsg }) => {
      const val = input.value.trim();
      if (!val) {
        showError(input, error, emptyMsg);
        formValid = false;
      } else if (!validate(val)) {
        showError(input, error, invalidMsg);
        formValid = false;
      } else {
        hideError(input, error);
      }
    });
    if (!formValid) {
      e.preventDefault();
    }
  });
</script>

    
</body>
</html>