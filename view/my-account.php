<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}   

// Dummy logic for role and username (replace with real session data)
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$email = $_SESSION['email']; 

// Assume the profile image is fetched from the database or is NULL
$profileImage = null; // Simulate that the profile photo is unavailable

// Use default profile image if no profile photo is available
if (empty($profileImage)) {
    $profileImage = '../image/defult.png'; // Path to the default image
}
?>

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
    <title>User Section</title>
    <link rel="stylesheet" href="./css/my-account.css">
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


</head>
<body>
<div class="user-container">
        <!-- Display the profile image -->
        <img src="../image/<?= htmlspecialchars($profileImage) ?>" alt="Profile Image">
        
        <!-- Display username and role -->
        <h1>Welcome, <?= htmlspecialchars($username) ?>!</h1>
        <p><strong>Role:</strong> <?= htmlspecialchars($role) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
        
        <!-- Change password and logout buttons -->
        <a href="change_password.php">Change Password</a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
