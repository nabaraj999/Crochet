<?php
session_start(); // Start the session at the beginning

$servername = "localhost"; // Change if necessary
$username = "root"; // Change this
$password = ""; // Change this
$dbname = "crochet"; // Change this

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = ''; // Initialize an empty error variable



// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL query to fetch user data with prepared statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            // Store user information in session
            $_SESSION['email'] = $row['email']; // Store the email in the session
            $_SESSION['username'] = $row['username']; // Assuming you have a username field
            $_SESSION['role'] = $row['role']; // Store the user's role in session

            // Redirect based on user role
            if ($row['role'] == 'admin') {
                header("Location: ../Admin/index.php");
                exit();  // Make sure to exit after redirect
            } else {
                header("Location: ../view/index.php");
                exit();  // Make sure to exit after redirect
            }
        } else {
            $error = "Invalid password.";
            header("Location: login.php?error=" . $error);
        }
    } else {
        $error = "Invalid email.";
        header("Location: login.php?error=" . $error);
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
