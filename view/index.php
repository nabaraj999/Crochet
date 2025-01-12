<?php
// Start the session
session_start();

// Example: Set a username in the session (only for testing)
// $_SESSION['username'] = "JohnDoe";

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']);
$username = $isLoggedIn ? $_SESSION['username'] : "Guest";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Learn crochet online with our comprehensive tutorials and patterns">
    <title>Crochet Learning - Master the Art of Crochet</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../view/css/index.css">
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


    <!-- Hero Section -->
    <section class="hero">
        <div class="search-container">
            <form class="search-bar" role="search">
                <input type="search" placeholder="Search patterns, tutorials..." aria-label="Search patterns and tutorials">
                <button type="submit" aria-label="Search">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <div class="hero-content">
            <h2>EXPLORE THE ART OF CROCHET <span role="img" aria-label="yarn">🧶</span></h2>
            <p>Learn, create, and connect with a community of crochet enthusiasts.</p>
            <a href="learning.html" class="learn-now-btn">Learn Now</a>
        </div>

        <div class="floating-widget">
            <button class="like-btn" id="likeButton" aria-label="Like">
                <i class="fas fa-heart"></i>
            </button>
            <div class="share-btn" id="shareButton">
                <button aria-label="Share" class="share-toggle">
                    <i class="fas fa-share-alt"></i>
                </button>
                <div class="share-options" id="shareOptions">
                    <a href="https://facebook.com/share" target="_blank" rel="noopener">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
                    <a href="https://instagram.com" target="_blank" rel="noopener">
                        <i class="fab fa-instagram"></i> Instagram
                    </a>
                    <a href="https://pinterest.com/pin/create" target="_blank" rel="noopener">
                        <i class="fab fa-pinterest-p"></i> Pinterest
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <h2 class="section-title">Welcome to Online Crochet Learning <span role="img" aria-label="yarn">🧶</span></h2>
        <div class="features-grid">
            <article class="feature">
                <img src="../image/hd.jpg" alt="Person learning basic crochet stitches" width="300" height="200">
                <h3>Learn How To Crochet</h3>
                <p>Master the basics with our step-by-step tutorials.</p>
            </article>

            <article class="feature">
                <img src="../image/st.jpg" alt="Handmade crochet gifts" width="300" height="200">
                <h3>Get Easy Crochet Gift Ideas</h3>
                <p>Discover perfect handmade gift projects.</p>
            </article>

            <article class="feature">
                <img src="../image/one.jpg" alt="Various crochet tools and materials" width="300" height="200">
                <h3>Understand Crochet</h3>
                <p>Learn the fundamentals and history of crochet.</p>
            </article>
        </div>
    </section>

    <!-- Community Section -->
    <section class="community" id="community">
        <div class="forum">
            <h2>Join Our Community <span role="img" aria-label="star">🌟</span></h2>
            <p>Connect with crochet enthusiasts worldwide! Share your creations, get inspired, and learn from others in our vibrant community.</p>
            <a href="join.html" class="btn">Join Now</a>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <form id="contact-form" action="submit_contact.php" method="POST">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required placeholder="Your Name">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required placeholder="Your Email">
    </div>

    <div class="form-group">
        <label for="message">Message</label>
        <textarea id="message" name="message" required placeholder="Your Message"></textarea>
    </div>

    <button type="submit">Send Message</button>
</form>

            <p id="responseMessage" aria-live="polite"></p>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-top">
                <h2>Online Crochet Learning</h2>
                <p>Craft your world, one loop at a time with Threads of Joy <span role="img" aria-label="yarn">🧶</span>.</p>
            </div>

            <div class="footer-grid">
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <nav aria-label="Footer navigation">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="collection.html">Collections</a></li>
                            <li><a href="free-patterns.html">Free Patterns</a></li>
                            <li><a href="my-account.html">My Account</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <address>
                        <p>Email: <a href="mailto:support@crochet.com">support@crochet.com</a></p>
                        <p>Phone: <a href="tel:+9779848747292">+977 984-874-7292</a></p>
                        <p>Address: Online Learning Crochet Nepal, Lalitpur City</p>
                    </address>
                </div>

                <div class="footer-column">
                    <h3>Follow Us</h3>
                    <div class="social-icons">
                        <a href="https://facebook.com" target="_blank" rel="noopener" aria-label="Follow us on Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://instagram.com" target="_blank" rel="noopener" aria-label="Follow us on Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://pinterest.com" target="_blank" rel="noopener" aria-label="Follow us on Pinterest">
                            <i class="fab fa-pinterest-p"></i>
                        </a>
                        <a href="https://youtube.com" target="_blank" rel="noopener" aria-label="Subscribe to our YouTube channel">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <div class="footer-column">
                    <h3>Newsletter</h3>
                    <form action="/subscribe" method="POST" class="newsletter-form">
                        <label for="newsletter-email">Subscribe to our newsletter</label>
                        <input type="email" id="newsletter-email" name="email" required placeholder="Enter your email">
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2024 Online Crochet Learning. All Rights Reserved.</p>
                <nav aria-label="Legal">
                    <a href="privacy.html">Privacy Policy</a> |
                    <a href="terms.html">Terms of Use</a>
                </nav>
            </div>
        </div>
    </footer>

        <script>
    function toggleAuth() {
        const authButton = document.getElementById('authButton');
        if (authButton.innerText === 'Logout') {
            // User logs out
            authButton.innerText = 'Login';
            window.location.href = 'login.html'; // Redirect to login page
        } else {
            // User logs in
            authButton.innerText = 'Logout';
            window.location.href = 'dashboard.html'; // Redirect to dashboard/homepage
        }
    }
</script>

    
</body>
</html>
