<?php
    session_start(); //start PHP session to manage user authentication and other session data across pages
?>

<!DOCTYPE html>
<html lang="en">
<!-- git testing -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHAN Tech | Aegis of Cyberprotection</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <div class="logo-container">
            <img src="Song_of_the_Welkin_Moon_Chapter.png" alt="CHAN Tech Logo" class="logo-icon" style="width: 75px; height: 75px;">
            <span class="logo-text">CHAN Tech</span>
        </div>
        <nav class="nav-links">
            <a href="#home">Home</a>
            <a href="#features">Features</a>
            <a href="#team">Team</a>
            <a href="#contact">Contact</a>
        </nav>
        <div class="nav-action"> <!-- Conditional display based on user authentication status -->
            <?php if(isset($_SESSION['user_name'])): 
                // Chop the name if it's over 20 characters
                $raw_name = $_SESSION['user_name'];
                $display_name = strlen($raw_name) > 20 ? substr($raw_name, 0, 20) . "..." : $raw_name;
            ?>

                <span style="color: var(--text-main); margin-right: 20px; font-weight: 600; font-family: var(--font-heading);">
                    Welcome, <span class="highlight"><?php echo htmlspecialchars($display_name); ?></span>!
                </span>
                <a href="logout.php" class="btn btn-outline" style="padding: 8px 16px; font-size: 12px; border-color: var(--text-muted); color: var(--text-muted);">LOG OUT</a>
            
            <?php else: ?>
                <a href="sign-up.php" class="btn btn-nav">SIGN UP</a>
                <a href="login.php" class="btn btn-nav" style="margin-left: 10px;">LOG IN</a>
            <?php endif; ?>
        </div>
    </header>

    <section id="home" class="hero">
        <div class="hero-content">
            <h1><!-- Conditional welcome message based on user authentication status -->
                <?php if(isset($_SESSION['user_name'])):
                    // Cut name to 13 characters for display in the hero section
                    $raw_name = $_SESSION['user_name'];
                    $display_name = strlen($raw_name) > 13 ? substr($raw_name, 0, 13) . "..." : $raw_name; 
                    ?>
                    WELCOME BACK,<br><span class="highlight"><?php echo strtoupper(htmlspecialchars($display_name)); ?></span>
                <?php else: ?>
                    SECURE YOUR<br><span class="highlight">DIGITAL WORLD</span>
                <?php endif; ?>
            </h1>

            <p>Comprehensive cybersecurity tailored for the Pinoy SME. Protect your shop from physical hacks and network breaches with the Aegis watchdog.</p>
            <div class="button-group">
                <a href="#features" class="btn btn-primary">Explore Features</a>
                <a href="#contact" class="btn btn-outline">Book a Demo</a>
            </div>
        </div>
        <div class="hero-image"> <!-- Image carousel -->
            <div class="carousel-container">
                <div class="carousel-slide active">
                    <div class="image-placeholder" style="border:none; width:100%; height:100%;">
                        <img src="image_1.jpg" alt="Aegis Device in Action">
                    </div>
                </div>

                <div class="carousel-slide">
                    <div class="image-placeholder" style="border:none; width:100%; height:100%;">
                        <img src="port_1.PNG" alt="AoC port 1">
                    </div>
                </div>

                <div class="carousel-slide">
                    <div class="image-placeholder" style="border:none; width:100%; height:100%;">
                        <img src="port_2.jpg" alt="AoC port 2">
                    </div>
                </div>                

                <div class="carousel-slide">
                    <div class="image-placeholder" style="border:none; width:100%; height:100%;">
                        <img src="UI_1.jpg" alt="AoC UI">
                    </div>
                </div>

                <button class="carousel-prev" onclick="moveSlide(-1)">&#10094;</button>
                <button class="carousel-next" onclick="moveSlide(1)">&#10095;</button>

                <div class="carousel-dots">
                    <span class="dot active" onclick="currentSlide(0)"></span>
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <h2>The Aegis Advantage</h2>
        <p>Enterprise-grade protection scaled and priced for local businesses.</p>
        
        <div class="feature-grid">
            <div class="feature-card">
                <div class="feature-icon">🔌</div>
                <h3>Plug & Play</h3>
                <p>No IT consultant required. Simply plug the Aegis box into your existing setup to secure your local network instantly.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🛡️</div>
                <h3>Port Blocking</h3>
                <p>Antivirus software can't stop physical breaches. Aegis actively monitors and blocks unauthorized USB devices in real-time.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📱</div>
                <h3>Real-Time Alerts</h3>
                <p>Powered by our custom Sentinel firmware, you get instant mobile notifications the moment a threat is neutralized.</p>
            </div>
        </div>
    </section>
    <!-- Team Profiles Section -->
    <section class="team-section" id="team">
        <h1 style="text-align: center; margin-bottom: 20px; font-size: 42px;">Meet the <span class="highlight">Team</span></h1>

        <div class="team-selectors">
            <div class="team-tab active-tab" onclick="selectMember('member1', this)">
                <img src="pictures/matthew_icon.png" alt="Matthew">
                <span class="tab-name">Matthew Antonio</span>
            </div>
            <div class="team-tab" onclick="selectMember('member2', this)">
                <img src="pictures/ron_icon.jpg" alt="Member 2">
                <span class="tab-name">Ronnel</span>
            </div>
            <div class="team-tab" onclick="selectMember('member3', this)">
                <img src="pictures/naluz_icon.jpg" alt="Member 3">
                <span class="tab-name">Christian</span>
            </div>
        </div>

        <div class="team-display-area">

            <div class="profile-card active-member" id="member1">
                <div class="profile-left">
                    <img src="pictures/matthew_sablay.jpg" alt="Profile Picture" class="profile-pic">
                </div>
                <div class="profile-right">
                    
                    <div class="info-slide active" id="m1-sec1">
                        <h3 class="profile-name" style="margin-bottom: 10px;">Matthew Antonio B. Bulaong</h3>
                        
                        <div class="title-divider"></div>

                        <div class="details-wrapper">
                            <p class="profile-detail"><i class="fas fa-user icon-accent"></i> <span><strong>Age:</strong> 22</span></p>
                            <p class="profile-detail"><i class="fas fa-laptop-code icon-accent"></i> <span><strong>Course:</strong> BS Computer Engineering, 4B</span></p>
                            <p class="profile-detail"><i class="fas fa-university icon-accent"></i> <span><strong>University:</strong> Bulacan State University - Meneses</span></p>
                        </div>

                        <div class="social-row">
                            <a href="https://www.linkedin.com/in/matthew-antonio-bulaong-1a1412391" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                            <a href="https://github.com/hinicus" title="GitHub"><i class="fab fa-github"></i></a>
                            <a href="mailto:bulaongmatthew55432@gmail.com" title="Email"><i class="fas fa-envelope"></i></a>
                        </div>

                        <button class="btn btn-primary slide-btn" onclick="switchSlide('member1', 'm1-sec2')">Personal Description &#10095;</button>
                    </div>

                    <div class="info-slide" id="m1-sec2">
                        <h4 class="slide-title">Personal Description</h4>
                        <p class="slide-text">I have a strong passion for technology and programming, and I enjoy creating innovative solutions to real-world problems. Throughout my academic journey, I have gained experience in various programming languages in my time in Meneses Campus such as <strong><i>Java</i>, <i>Python</i>, <i>C++</i>, <i>HTML</i>, <i>CSS</i>, <i>JavaScript</i>, and <i>PHP</i></strong>. I have also worked on several projects that have allowed me to apply my skills and knowledge in practical settings.</p>
                        <div class="slide-controls">
                            <button class="btn btn-outline slide-btn" onclick="switchSlide('member1', 'm1-sec1')">&#10094; Back</button>
                            <button class="btn btn-primary slide-btn" onclick="switchSlide('member1', 'm1-sec3')">Hobbies &#10095;</button>
                        </div>
                    </div>

                    <div class="info-slide" id="m1-sec3">
                        <h4 class="slide-title">Hobbies & Interests</h4>
                        <ul class="slide-list">
                            <li>Cybersecurity & Network Defense</li>
                            <li>Web Development & UI/UX Design</li>
                            <li>Arduino Microcontroller Projects</li>
                            <li>Playing Video Games</li>
                            <li>Listening to Music</li>
                        </ul>
                        <div class="slide-controls">
                            <button class="btn btn-outline slide-btn" onclick="switchSlide('member1', 'm1-sec2')">&#10094; Back</button>
                            <button class="btn btn-primary slide-btn" onclick="switchSlide('member1', 'm1-sec4')">Vision &#10095;</button>
                        </div>
                    </div>

                    <div class="info-slide" id="m1-sec4">
                        <h4 class="slide-title">Vision (5 Years From Now)</h4>
                        <p class="slide-text">In five years, I envision myself as a leading Cybersecurity Analyst or Full-Stack Engineer, developing enterprise-grade security tools and innovative web applications that empower local businesses in the Philippines.</p>
                        <div class="slide-controls">
                            <button class="btn btn-outline slide-btn" onclick="switchSlide('member1', 'm1-sec3')">&#10094; Back</button>
                            <button class="btn btn-primary slide-btn" onclick="switchSlide('member1', 'm1-sec5')">Favorite Quote &#10095;</button>
                        </div>
                    </div>

                    <div class="info-slide" id="m1-sec5">
                        <div class="quote-container">
                            <p class="fancy-quote">"Do not wait to strike till the iron is hot; but make it hot by striking."</p>
                            <p class="quote-author">- William Butler Yeats</p>
                        </div>
                        <button class="btn btn-outline slide-btn" onclick="switchSlide('member1', 'm1-sec1')">&#8634; Back to Start</button>
                    </div>

                </div>
            </div>

            <div class="profile-card" id="member2">
                <div class="profile-left">
                    <img src="pictures/ron_sablay.jpg" alt="Profile Picture" class="profile-pic">
                </div>
                <div class="profile-right">
                    <div class="info-slide active" id="m2-sec1">
                        <h3 class="profile-name" style="margin-bottom: 10px;">Ronnel V. Vasallo</h3>
                        
                        <div class="title-divider"></div>

                        <div class="details-wrapper">
                            <p class="profile-detail"><i class="fas fa-user icon-accent"></i> <span><strong>Age:</strong> 25</span></p>
                            <p class="profile-detail"><i class="fas fa-laptop-code icon-accent"></i> <span><strong>Course:</strong> BS Computer Engineering, 4B</span></p>
                            <p class="profile-detail"><i class="fas fa-university icon-accent"></i> <span><strong>University:</strong> Bulacan State University - Meneses</span></p>
                        </div>

                        <div class="social-row">
                            <a href="" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                            <a href="" title="GitHub"><i class="fab fa-github"></i></a>
                            <a href="" title="Email"><i class="fas fa-envelope"></i></a>
                        </div>
                    
                        <button class="btn btn-primary slide-btn" onclick="switchSlide('member2', 'm2-sec2')">Personal Description &#10095;</button>
                    </div>
                    
                    <div class="info-slide" id="m2-sec2">
                        <h4 class="slide-title">Personal Description</h4>
                        <p class="slide-text">Ronnel is a dedicated cybersecurity enthusiast with a passion for protecting digital assets and contributing to a safer digital environment.</p>
                        <div class="slide-controls">
                            <button class="btn btn-outline slide-btn" onclick="switchSlide('member2', 'm2-sec1')">&#10094; Back</button>
                            <button class="btn btn-primary slide-btn" onclick="switchSlide('member2', 'm2-sec3')">Hobbies &#10095;</button>
                        </div>
                    </div>
                    <div class="info-slide" id="m2-sec3">
                        <h4 class="slide-title">Hobbies & Interests</h4>
                        <ul class="slide-list">
                            <li>Learning Penetration Testing and SOC</li>
                            <li>Playing Organ</li>
                            <li>Watching Anime</li>
                            <li>Exercising</li>
                            <li>Aquarium Fish Keeping</li>
                        </ul>
                        <div class="slide-controls">
                            <button class="btn btn-outline slide-btn" onclick="switchSlide('member2', 'm2-sec2')">&#10094; Back</button>
                            <button class="btn btn-primary slide-btn" onclick="switchSlide('member2', 'm2-sec4')">Vision &#10095;</button>
                        </div>
                    </div>
                    <div class="info-slide" id="m2-sec4">
                        <h4 class="slide-title">Vision (5 Years From Now)</h4>
                        <p class="slide-text">I envision myself as a skilled cybersecurity professional, holding topnotch certifications both in attack and defense, making a positive impact in protecting digital assets and contributing to a safer digital environment.</p>
                        <div class="slide-controls">
                            <button class="btn btn-outline slide-btn" onclick="switchSlide('member2', 'm2-sec3')">&#10094; Back</button>
                            <button class="btn btn-primary slide-btn" onclick="switchSlide('member2', 'm2-sec5')">Favorite Quote &#10095;</button>
                        </div>
                    </div>
                    <div class="info-slide" id="m2-sec5">
                        <div class="quote-container">
                            <p class="fancy-quote">"Whatever will be, will be"</p>
                        </div>
                        <button class="btn btn-outline slide-btn" onclick="switchSlide('member2', 'm2-sec1')">&#8634; Back to Start</button>
                    </div>
                </div>
            </div>

            <div class="profile-card" id="member3">
                <div class="profile-left">
                    <img src="pictures/naluz_sablay.jpg" alt="Profile Picture" class="profile-pic">
                </div>
                <div class="profile-right">
                    <div class="info-slide active" id="m3-sec1">
                        <h3 class="profile-name" style="margin-bottom: 10px;">Chrisitan M. Naluz</h3>
                        
                        <div class="title-divider"></div>

                        <div class="details-wrapper">
                            <p class="profile-detail"><i class="fas fa-user icon-accent"></i> <span><strong>Age:</strong> 21</span></p>
                            <p class="profile-detail"><i class="fas fa-laptop-code icon-accent"></i> <span><strong>Course:</strong> BS Computer Engineering, 4B</span></p>
                            <p class="profile-detail"><i class="fas fa-university icon-accent"></i> <span><strong>University:</strong> Bulacan State University - Meneses</span></p>
                        </div>

                        <div class="social-row">
                            <a href="https://www.linkedin.com/in/christian-naluz-22ba713b8/" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                            <a href="https://github.com/christianmatito21-web" title="GitHub"><i class="fab fa-github"></i></a>
                            <a href="mailto:christianmatito21@gmail.com" title="Email"><i class="fas fa-envelope"></i></a>
                        </div>
                    
                        <button class="btn btn-primary slide-btn" onclick="switchSlide('member3', 'm3-sec2')">Personal Description &#10095;</button>
                    </div>
                    <div class="info-slide" id="m3-sec2">
                        <h4 class="slide-title">Personal Description</h4>
                        <p class="slide-text">I have a strong passion for logic and mathematics, which guides my approach to problem-solving and programming. 
                            I have developed skills in various programming languages, including Java, Python, C++, HTML, CSS, JavaScript, and PHP. 
                            I have also worked on projects that helped me apply my skills in real-world situations and improve my analytical thinking.</p>
                        <div class="slide-controls">
                            <button class="btn btn-outline slide-btn" onclick="switchSlide('member3', 'm3-sec1')">&#10094; Back</button>
                            <button class="btn btn-primary slide-btn" onclick="switchSlide('member3', 'm3-sec3')">Hobbies &#10095;</button>
                        </div>
                    </div>
                    <div class="info-slide" id="m3-sec3">
                        <h4 class="slide-title">Hobbies & Interests</h4>
                        <ul class="slide-list">
                            <li>Playing online games</li>
                            <li>Watching movies</li>
                            <li>Coding/programming</li>
                            <li>Playing chess</li>
                            <li>Strategy games</li>
                        </ul>
                        <div class="slide-controls">
                            <button class="btn btn-outline slide-btn" onclick="switchSlide('member3', 'm3-sec2')">&#10094; Back</button>
                            <button class="btn btn-primary slide-btn" onclick="switchSlide('member3', 'm3-sec4')">Vision &#10095;</button>
                        </div>
                    </div>
                    <div class="info-slide" id="m3-sec4">
                        <h4 class="slide-title">Vision (5 Years From Now)</h4>
                        <p class="slide-text">Five years from now, I want to have a house and marry the girl I love, building a stable and happy life together while continuing 
                            to grow both personally and professionally, and I want to become a successful engineer (even if the chances of it happening may seem very small.)</p>
                        <div class="slide-controls">
                            <button class="btn btn-outline slide-btn" onclick="switchSlide('member3', 'm3-sec3')">&#10094; Back</button>
                            <button class="btn btn-primary slide-btn" onclick="switchSlide('member3', 'm3-sec5')">Favorite Quote &#10095;</button>
                        </div>
                    </div>
                    <div class="info-slide" id="m3-sec5">
                        <div class="quote-container">
                            <p class="fancy-quote">"Always look on the bright side of life"</p>
                        </div>
                        <button class="btn btn-outline slide-btn" onclick="switchSlide('member3', 'm3-sec1')">&#8634; Back to Start</button>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="contact-box">
            <h2>Ready to Secure Your Shop?</h2>
            <p>Upgrade your security for just ₱21,500. Contact our Bulacan team today to schedule your free "Live Hack" demonstration.</p>
            <a href="mailto:info@chantech.com" class="btn btn-primary" style="margin-bottom: 20px;">Email Us!</a>
            <p style="font-size: 14px;">📍 Meneses, Bulakan, Bulacan, 3000</p>
        </div>
    </section>

    <footer>
        <p>&copy; 2026 CHAN Tech. Securing the future of Filipino SMEs.</p>
    </footer>

    <script>
      let slideIndex = 0;
const slides = document.querySelectorAll('.carousel-slide');
const dots = document.querySelectorAll('.dot');
let autoSlideInterval = 5000;
let slideTimer;

// Show a specific slide
function showSlide(n) {
    // Wrap slide index correctly (works for negative numbers)
    slideIndex = ((n % slides.length) + slides.length) % slides.length;

    // Hide all slides
    slides.forEach(slide => slide.classList.remove('active'));

    // Show current slide
    slides[slideIndex].classList.add('active');

    // Update dots
    dots.forEach(dot => dot.classList.remove('active'));
    dots[slideIndex].classList.add('active');
}

// Move forward/backward
function moveSlide(n) {
    showSlide(slideIndex + n);
    resetTimer();
}

// Go to a specific slide
function currentSlide(n) {
    showSlide(n);
    resetTimer();
}

// Reset auto-slide timer
function resetTimer() {
    clearInterval(slideTimer);
    slideTimer = setInterval(() => moveSlide(1), autoSlideInterval);
}

// Initialize
showSlide(slideIndex);
slideTimer = setInterval(() => moveSlide(1), autoSlideInterval);

    // Click events
    dots.forEach((dot, index) => dot.addEventListener('click', () => currentSlide(index)));
    slides.forEach(slide => slide.addEventListener('click', () => moveSlide(1)));

        // Function to switch between profile sections
        function switchSlide(memberCardId, targetSlideId) {
        const card = document.getElementById(memberCardId); //Find the parent card
        
        // 2. Find all slides inside THIS specific card
        const slides = card.querySelectorAll('.info-slide');
        
        // 3. Remove 'active' class from all slides
        slides.forEach(slide => {
            slide.classList.remove('active');
        });

        // 4. Add 'active' class to the specific target slide
        const targetSlide = document.getElementById(targetSlideId);
        targetSlide.classList.add('active');
        }

        // Function to switch between the 3 main team members
        function selectMember(memberId, clickedTab) {
        // 1. Hide all profile cards
        const allCards = document.querySelectorAll('.profile-card');
        allCards.forEach(card => card.classList.remove('active-member'));

        // 2. Remove 'active-tab' styling from all tabs
        const allTabs = document.querySelectorAll('.team-tab');
        allTabs.forEach(tab => tab.classList.remove('active-tab'));

        // 3. Show the selected profile card
        const targetCard = document.getElementById(memberId);
        targetCard.classList.add('active-member');

        // 4. Highlight the clicked tab
        clickedTab.classList.add('active-tab');
        
        //Reset: Reset to Section 1 every switch members
        switchSlide(memberId, memberId.charAt(0) + memberId.charAt(6) + '-sec1');
        }

        // --- Scrollspy Navigation ---
        // 1. Grab all sections that have an ID, and all the links in the navbar
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-links a');

        // 2. Configure the observer
        const observerOptions = {
            root: null,
            rootMargin: '-20% 0px -70% 0px', // Triggers when the section reaches the upper part of the screen
            threshold: 0 
        };

        // 3. Create the observer function
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Get the ID of the section currently on screen
                    const currentId = entry.target.getAttribute('id');
                    
                    // Loop through all nav links
                    navLinks.forEach(link => {
                        // Remove the glow from all links
                        link.classList.remove('active-nav');
                        
                        // If the link's href matches the current section, make it glow
                        if (link.getAttribute('href') === `#${currentId}`) {
                            link.classList.add('active-nav');
                        }
                    });
                }
            });
        }, observerOptions);

        // 4. Tell the observer to start watching every section
        sections.forEach(section => {
            sectionObserver.observe(section);
        });
    </script>

</body>
</html>