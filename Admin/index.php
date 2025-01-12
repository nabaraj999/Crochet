<?php
// Start the session
session_start();

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
        <a href="collection.php">Collection</a>
        <a href="manage_users.php">manage_users</a>
        <a href="free_pattern.php">pattern</a>
        <a href="view_patterns.php">Edit pattern</a>
        <a href="feedback.php">Feedback</a>
    </nav>
    <div class="user-actions">
        <a href="my-account.php" aria-label="My Account">
            <i class="fas fa-user-circle"></i>
        </a>
        <span id="username" class="username">
            <?php echo htmlspecialchars($username); ?>
        </span>
        <a href="<?php echo $isLoggedIn ? 'logout.php' : 'login.php'; ?>" class="auth-btn">
            <?php echo $isLoggedIn ? 'Logout' : 'Login'; ?>
        </a>
    </div>
</header>  

<body>
<h1 class="admin-heading">Welcome to the Admin Panel</h1>
