<?php
// Start the session
session_start();

$isLoggedIn = isset($_SESSION['username']);
$username = $isLoggedIn ? $_SESSION['username'] : "Guest";
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../view/css/index.css">
    <link rel="stylesheet" href="../view/css/course.css">
</head>
<body>
    <!-- Header Section -->
    <header class="header">
    <div class="logo">
        <h1><a href="index.php">Crochet Learning</a></h1>
    </div>
    <nav class="navbar" aria-label="Main navigation">
        <a href="index.php" aria-current="page">Home</a>
        <a href="about.php">About</a>
        <a href="collection.php">Collection</a>
        <a href="course.php">Course</a>
        <a href="display_patterns.php">Pattern</a>
        
    </nav>
    <div class="user-actions">
        <a href="my-account.php" aria-label="My Account">
            <i class="fas fa-user-circle"></i>
        </a>
        <span id="username" class="username">
            <?php echo htmlspecialchars($username); ?>
        </span>
        <a href="<?php echo $isLoggedIn ? 'logout.php' : '../Login/login.php'; ?>" class="auth-btn">
            <?php echo $isLoggedIn ? 'Logout' : 'Login'; ?>
        </a>
    </div>
</header>
<body>
  
</head>
<body>
    <div class="containera">
        <div class="course-content">
            <div class="course-header">
                <h1>Course Curriculum</h1>
                <p>Here's a detailed breakdown of what exactly you will learn.</p>
            </div>
            
            <div class="modules">
                <div class="module active">
                    <div class="module-header" onclick="toggleModule(this)">
                        <h3>Introduction to Crochet</h3>
                        <span class="module-badge">Module 1</span>
                    </div>
                    <div class="module-content">
                        <div class="lesson">
                            <div class="lesson-title">
                                <span>📹</span>
                                <span>History and benefits of crochet.</span>
                            </div>
                            <span class="duration">15:53</span>
                        </div>
                        <div class="lesson">
                            <div class="lesson-title">
                                <span>📹</span>
                                <span>Tools and materials</span>
                            </div>
                            <span class="duration">38:19</span>
                        </div>

                        <div class="lesson">
                            <div class="lesson-title">
                                <span>📹</span>
                                <span>Understanding crochet terms</span>
                            </div>
                            <span class="duration">1 hour</span>
                        </div>
                    </div>
                </div>
                
                <div class="module">
                    <div class="module-header" onclick="toggleModule(this)">
                        <h3>Project</h3>
                        <span class="module-badge">Module 2</span>
                    </div>
                    <div class="module-content">
                        <div class="lesson">
                            <div class="lesson-title">
                                <span>📹</span>
                                <span>Simple project</span>
                            </div>
                            <span class="duration">1.5 hour</span>
                        </div>
                        <div class="lesson">
                            <div class="lesson-title">
                                <span>📹</span>
                                <span>Skill Based project</span>
                            </div>
                            <span class="duration">2 hour</span>
                        </div>

                        <div class="lesson">
                            <div class="lesson-title">
                                <span>📹</span>
                                <span>Final Project</span>
                            </div>
                            <span class="duration">3 hour   </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        <div class="course-sidebar">
            <div class="course-card">
                <div class="course-image">
                    <img src="../image/crochet-image.jpg" alt="Course Image">
                </div>
                <h2 class="course-title">Master in CROCHET</h2>
                <p class="course-description">The Ultimate Guide To Productivity and Happiness</p>
                <div class="course-stats">
                    <span class="rating">★★★★★</span>
                    <span>10,000+ Happy Learners</span>
                </div>
                <button class="join-button" id="joinNowButton">Join Now</button>
                <ul class="featuresa">
                    <li>Easy payment method</li>
                    <li>Lifetime Access of the Course</li>
                    <li>Learn Anytime, Anywhere</li>
                    <li>24/7 Instant Email Support</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        function toggleModule(header) {
            const module = header.parentElement;
            const wasActive = module.classList.contains('active');
            
            // Close all modules
            document.querySelectorAll('.module').forEach(mod => {
                mod.classList.remove('active');
            });
            
            // If the clicked module wasn't active, open it
            if (!wasActive) {
                module.classList.add('active');
            }
        }
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('joinNowButton').addEventListener('click', function () {
                // Replace with your desired URL
                window.location.href = 'course_payment.php';
            });
        });
    </script>
</body>
</html>