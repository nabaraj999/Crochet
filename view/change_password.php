<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Handle password change logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database configuration
    $host = 'localhost';
    $dbname = 'FreePatterns';
    $username = 'root';
    $password = '';

    // Create database connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get new password details from the form
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate new passwords match
    if ($new_password !== $confirm_password) {
        $error = "New passwords do not match.";
    } else {
        // Update password in the database
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
        $stmt->bind_param("ss", $hashed_password, $_SESSION['username']);

        if ($stmt->execute()) {
            $success = "Password successfully changed!";
        } else {
            $error = "Failed to update password.";
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="./css/change_password.css">
</head>
<body>
    <div class="password-container">
        <h1>Change Password</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <p class="success"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>
        <form action="" method="POST">
            <input type="password" name="new_password" placeholder="New Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
            <button type="submit">Change Password</button>
        </form>
    </div>
</body>
</html>
