<?php
    include '../connection/connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $materials = $_POST['materials'];
    $pattern_notes = $_POST['pattern_notes'];

    // Handle file upload
    $photo = $_FILES['photo']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($photo);

    // Create uploads directory if it doesn't exist
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Update query
    if (!empty($photo)) {
        // Move uploaded file to target directory
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
            $stmt = $conn->prepare("UPDATE patterns SET name = ?, photo = ?, materials = ?, pattern_notes = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $name, $target_file, $materials, $pattern_notes, $id);
        } else {
            die("Failed to upload photo.");
        }
    } else {
        $stmt = $conn->prepare("UPDATE patterns SET name = ?, materials = ?, pattern_notes = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $materials, $pattern_notes, $id);
    }

    // Execute query
    if ($stmt->execute()) {
        echo "Pattern updated successfully! <a href='view_patterns.php'>Go back</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
