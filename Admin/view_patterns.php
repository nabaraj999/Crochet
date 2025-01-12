<?php
include '../connection/connection.php';
// Fetch patterns
$sql = "SELECT * FROM patterns";
$result = $conn->query($sql);
?>
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
    <title>View Patterns</title>
    <link rel="stylesheet" href="./css/view_patterns.css">
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
    <h1>All Submitted Patterns</h1>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 80%; margin: 0 auto;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Photo</th>
                <th>Materials</th>
                <th>Pattern Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><img src="<?= htmlspecialchars($row['photo']) ?>" alt="Photo" style="width: 100px;"></td>
                    <td><?= htmlspecialchars($row['materials']) ?></td>
                    <td><?= htmlspecialchars($row['pattern_notes']) ?></td>
                    <td>
                        <a  class ="ab"href="edit_pattern.php?id=<?= $row['id'] ?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
