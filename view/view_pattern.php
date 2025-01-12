<?php
include '../connection/connection.php';
// Fetch pattern details by ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM patterns WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $pattern = $result->fetch_assoc();
    $stmt->close();
}

// If pattern not found, redirect to the main page
if (!$pattern) {
    header("Location: display_patterns.php");
    exit();
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
    <title>Pattern Details</title>
    <link rel="stylesheet" href="./css/view_pattern.css">
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
    <div class="details-container">
        <img src="<?= htmlspecialchars($pattern['photo']) ?>" alt="Pattern Image">
        <h1><?= htmlspecialchars($pattern['name']) ?></h1>
        <p><strong>Materials:</strong> <?= htmlspecialchars($pattern['materials']) ?></p>
        <p><strong>Pattern Notes:</strong> <?= nl2br(htmlspecialchars($pattern['pattern_notes'])) ?></p>
        <a href="display_patterns.php">Back to Patterns</a>
    </div>
</body>
</html>
