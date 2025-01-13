
<?php
include '../connection/connection.php';
// Fetch patterns from the database
$sql = "SELECT id, name, photo FROM patterns ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<?php
// Start the session
session_start();

$isLoggedIn = isset($_SESSION['username']);
$username = $isLoggedIn ? $_SESSION['username'] : "Guest";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patterns List</title>
    <link rel="stylesheet" href="./css/display_patterns.css">
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
    <h1 style="text-align: center;">All Patterns</h1>
    <div class="pattern-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="pattern-card">
                    <img src="<?= htmlspecialchars($row['photo']) ?>" alt="Pattern Image">
                    <h3><?= htmlspecialchars($row['name']) ?></h3>
                    <a href="view_pattern.php?id=<?= $row['id'] ?>">View Details</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align: center;">No patterns available yet. Be the first to submit one!</p>
        <?php endif; ?>
    </div>
</body>
</html>
