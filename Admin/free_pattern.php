
<?php
include "../connection/connection.php";   

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'];
    $materials = $_POST['materials'];
    $pattern_notes = $_POST['pattern_notes'];

    // Handle file upload
    $photo = $_FILES['photo']['name'];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($photo);

    // Create uploads directory if it doesn't exist
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Move uploaded file to target directory
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
        // Prepare SQL query to insert data
        $stmt = $conn->prepare("INSERT INTO patterns (name, photo, materials, pattern_notes) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $target_file, $materials, $pattern_notes);

        // Execute query
        if ($stmt->execute()) {
            echo "Pattern submitted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Failed to upload photo.";
    }
}

$conn->close();
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
    <link rel="stylesheet" href="./css/free_patterns.css">
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
        a href="view_patterns.php">Edit pattern</a>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Pattern Submission</title>
</head>
<body>
    <h1>Submit Your Free Pattern</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*" required><br><br>

        <label for="materials">Materials:</label>
        <textarea id="materials" name="materials" rows="4" required></textarea><br><br>

        <label for="pattern_notes">Pattern Notes:</label>
        <textarea id="pattern_notes" name="pattern_notes" rows="6" required></textarea><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>

</body>
</html>