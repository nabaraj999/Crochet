<?php
// Connect to the database
include 'db_connect.php';

// Check if 'id' is provided in the URL
if (isset($_GET['id'])) {
    // Sanitize the ID to prevent SQL injection
    $user_id = intval($_GET['id']);
    
    // SQL query to delete the user by ID
    $sql = "DELETE FROM users WHERE id = $user_id";
    
    if (mysqli_query($conn, $sql)) {
        // Redirect back to the user management page with a success message
        header("Location: user_management.php?message=User+deleted+successfully");
        exit();
    } else {
        // If there's an error, display it
        echo "Error deleting user: " . mysqli_error($conn);
    }
} else {
    // If no ID is provided, redirect back to user management
    header("Location: manage_users.php");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
