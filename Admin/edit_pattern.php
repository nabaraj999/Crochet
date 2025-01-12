<?php
include '../connection/connection.php';
// Fetch the pattern details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM patterns WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $pattern = $result->fetch_assoc();
    $stmt->close();
}

// If pattern not found, redirect
if (!$pattern) {
    header("Location: view_patterns.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pattern</title>
    <link rel="stylesheet" href="./css/edit_pattern.css">
</head>
<body>
    <h1>Edit Pattern</h1>
    <form action="update_pattern.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $pattern['id'] ?>">

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($pattern['name']) ?>" required><br><br>

        <label for="photo">Photo (Leave blank to keep current):</label>
        <input type="file" id="photo" name="photo" accept="image/*"><br><br>
        <p>Current Photo: <img src="<?= htmlspecialchars($pattern['photo']) ?>" alt="Photo" style="width: 100px;"></p>

        <label for="materials">Materials:</label>
        <textarea id="materials" name="materials" rows="4" required><?= htmlspecialchars($pattern['materials']) ?></textarea><br><br>

        <label for="pattern_notes">Pattern Notes:</label>
        <textarea id="pattern_notes" name="pattern_notes" rows="6" required><?= htmlspecialchars($pattern['pattern_notes']) ?></textarea><br><br>

        <button type="submit">Update Pattern</button>
    </form>
</body>
</html>
