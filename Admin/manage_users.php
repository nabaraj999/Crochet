
<?php
include '../connection/connection.php';
// Handle form submission to add a new user
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";
    if (mysqli_query($conn, $sql)) {
        echo "<p class='success-message'>User added successfully.</p>";
    } else {
        echo "<p class='error-message'>Error adding user: " . mysqli_error($conn) . "</p>";
    }
}

// Fetch users from the database
$result = mysqli_query($conn, "SELECT * FROM users");
?>
<?php
// Start the session
session_start();

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']);
$username = $isLoggedIn ? $_SESSION['username'] : "Guest";
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
<link rel="stylesheet" href="./css/manage_users.css">
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

<div class="container">
    <h2>User Management</h2>    
    <!-- Add User Form -->
    <form action="" method="POST">
        <h3>Add New User</h3>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        
        <!-- Role Selection -->
        <label for="role">Role:</label>
        <select name="role" id="role" required>
            <option value="User">User</option>
            <option value="Admin">Admin</option>
        </select>
        
        <button type="submit" name="add_user">Add User</button>
    </form>

    <!-- Display Users -->
    <h3>Existing Users</h3>
    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td class="action-links">
    <a href="edit_user.php?id=<?php echo $row['id']; ?>">Edit</a>
    <a href="delete_user.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
    <a href="view_user.php?id=<?php echo $row['id']; ?>">View</a> <!-- New View Link -->
</td>

                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

<script>   function logout() {
            alert('You have been logged out.');
            // Redirect to logout page or add logout logic
            window.location.href = 'logout.php';
        }
        </script>
</body>
</html>
