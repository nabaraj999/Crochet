
<?php
session_start();

$isLoggedIn = isset($_SESSION['username']);
$username = $isLoggedIn ? $_SESSION['username'] : "Guest";
?>

<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="./css/course_payment.css">
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


<body>
  <div class="containera">
    <div class="product-details">
      <h1>Master in CROCHET</h1>
      <div class="price">$139</div>
      <img src="../image/crochet-image.jpg" alt="Course Preview" class="product-image">
      <div class="features">
        36 lessons | 2.5 Hours of Content | Lifetime Access | Watch it any time, as many times
      </div>
      <p>Take your productivity to the next level while maximizing your happiness and life satisfaction at the same time. Fully updated from ground up with new worksheets and now available in Hindi with English subtitles.</p>
    </div>
    
    <div class="payment-details">
      <h2>Payment Details</h2>
      <p>Complete your purchase by providing your payment details.</p>
      
      <form id="payment-form">
        <div class="form-group">
          <input type="text" placeholder="Name" required>
        </div>
        <div class="form-group">
          <input type="email" placeholder="Email" required>
        </div>
        <div class="form-group phone-input">
          <input type="text" value="+977" class="country-code" readonly>
          <input type="tel" placeholder="Phone" required>
        </div>
        <div class="form-group">
          <input type="text" placeholder="Zipcode">
        </div>
        
        <div class="coupon-section" id="coupon-toggle">
          Have a coupon?
        </div>
        
        <div class="payment-summary">
          <div class="payment-row">
            <span>Service</span>
            <span>$139.00</span>
          </div>
          <div class="payment-row">
            <strong>Amount to be paid:</strong>
            <strong>$139.00</strong>
          </div>
        </div>
        
        <button type="submit">Proceed to pay $139.00</button>
        
        <div class="payment-methods">
          <img src="/api/placeholder/40/25" alt="UPI" class="payment-method">
          <img src="/api/placeholder/40/25" alt="PayTM" class="payment-method">
          <img src="/api/placeholder/40/25" alt="Visa" class="payment-method">
          <img src="/api/placeholder/40/25" alt="Mastercard" class="payment-method">
          <img src="/api/placeholder/40/25" alt="RuPay" class="payment-method">
          <img src="/api/placeholder/40/25" alt="GPay" class="payment-method">
        </div>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Coupon toggle functionality
      const couponToggle = document.getElementById('coupon-toggle');
      let couponVisible = false;
      
      couponToggle.addEventListener('click', () => {
        if (!couponVisible) {
          const couponInput = document.createElement('div');
          couponInput.className = 'form-group';
          couponInput.style.marginTop = '15px';
          couponInput.innerHTML = `
            <input type="text" placeholder="Enter coupon code" id="coupon-input">
          `;
          couponToggle.appendChild(couponInput);
          couponVisible = true;
          
          // Add animation to the input
          couponInput.style.opacity = '0';
          couponInput.style.transform = 'translateY(-10px)';
          requestAnimationFrame(() => {
            couponInput.style.transition = 'all 0.3s ease';
            couponInput.style.opacity = '1';
            couponInput.style.transform = 'translateY(0)';
          });
        }
      });

      // Form submission animation
      const form = document.getElementById('payment-form');
      form.addEventListener('submit', (e) => {
        e.preventDefault();
        const button = form.querySelector('button');
        button.style.transform = 'scale(0.95)';
        setTimeout(() => {
          button.style.transform = '';
        }, 200);
      });

      // Input focus animations
      const inputs = document.querySelectorAll('input');
      inputs.forEach(input => {
        input.addEventListener('focus', () => {
          input.style.transform = 'scale(1.02)';
          input.style.transition = 'transform 0.3s ease';
        });
        
        input.addEventListener('blur', () => {
          input.style.transform = '';
        });
      });
    });
  </script>
</body>
</html>