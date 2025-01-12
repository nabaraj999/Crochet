
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crochet";

$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Get selected category from URL or form submission
$category = isset($_GET['category']) ? $_GET['category'] : '';

// SQL query to get products based on the selected category
$sql = "SELECT * FROM products";
if ($category) {
    $sql .= " WHERE category = '$category'";
}
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
    <title>Product Collection</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Learn crochet online with our comprehensive tutorials and patterns">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../view/css/index.css">
    <link rel="stylesheet" href="./css/collection.css">
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
        <a href="<?php echo $isLoggedIn ? 'logout.php' : 'login.php'; ?>" class="auth-btn">
            <?php echo $isLoggedIn ? 'Logout' : 'Login'; ?>
        </a>
    </div>
</header>
<body>

<h1 class="collection">Collection</h1>

<!-- Category Filter -->
<form method="GET" action="">
    <select name="category" onchange="this.form.submit()">
        <option value="">All</option>
        <option value="Vest" <?php if($category == 'Vest') echo 'selected'; ?>>Vest Collection</option>
        <option value="winter" <?php if($category == 'winter') echo 'selected'; ?>>Winter Collection</option>
        <option value="hook" <?php if($category == 'hook') echo 'selected'; ?>>Hook Collection</option>
        <option value="yarn" <?php if($category == 'yarn') echo 'selected'; ?>>Yarn Collection</option>
        <option value="Other" <?php if($category == 'Other') echo 'selected'; ?>>Other</option>
    </select>
</form>

<div class="product-container">
    <?php
    if ($result->num_rows > 0) {
        // Output each product as a card
        while ($row = $result->fetch_assoc()) {
            // Display product only if it matches the selected category or all categories if no selection is made
            if (!$category || $row['category'] == $category) {
                echo "<div class='product-card'>";
                echo "<img src='../uploads/" . $row['product_photo'] . "' alt='" . $row['product_name'] . "'>";
                echo "<p>" . $row['product_name'] . "</p>";
                echo "</div>";
            }
        }
    } else {
        echo "<p>No products available in this category.</p>";
    }
    ?>
</div>


<?php
// Close the connection
$conn->close();
?>
