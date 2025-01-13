<?php
include "../connection/connection.php";   

// Handling the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_name = $conn->real_escape_string($_POST['product_name']);
    $category = $conn->real_escape_string($_POST['category']);
    $description = $conn->real_escape_string($_POST['description']);

    // Handle file upload
    if (isset($_FILES['product_photo']) && $_FILES['product_photo']['error'] == 0) {
        $target_dir = "../uploads/";
        $file_name = basename($_FILES["product_photo"]["name"]);
        $target_file = $target_dir . $file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validate file type
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($file_type, $allowed_types)) {
            die("Error: Only JPG, JPEG, PNG, and GIF files are allowed.");
        }

        // Move the uploaded file to the server
        if (!move_uploaded_file($_FILES["product_photo"]["tmp_name"], $target_file)) {
            die("Error: Unable to upload the file.");
        }
    } else {
        die("Error: Please upload a valid photo.");
    }

    // Insert data into the database
    $sql = "INSERT INTO products (product_name, product_photo, category, description) 
            VALUES ('$product_name', '$file_name', '$category', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
