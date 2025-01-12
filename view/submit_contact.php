<?php
include '../connection/connection.php';
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert feedback into the database
    $sql = "INSERT INTO feedback (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to index.php if successful
        header('Location: index.php');
        exit(); // Ensure the script stops after the redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
}

// Close the connection
$conn->close();
?>
