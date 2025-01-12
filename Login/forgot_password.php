<?php

$servername = "localhost"; // Change if necessary
$username = "root"; // Change this
$password = ""; // Change this
$dbname = "booknest"; // Change this

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$error_message = ''; // Initialize error message

if (isset($_POST['reset_password'])) {
    $email = $_POST['email'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Check if new passwords match
    if ($new_password != $confirm_new_password) {
        $error_message = 'New passwords do not match. Please try again.';
    } else {
        // Check if the email exists and verify old password
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Verify old password
            if (password_verify($old_password, $user['password'])) {
                // Hash the new password
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
                $stmt->bind_param("ss", $hashed_new_password, $email);

                if ($stmt->execute()) {
                    $error_message = 'Password reset successful. You can now log in with your new password.';
                } else {
                    $error_message = 'Error: Could not reset password. Please try again.';
                }
            } else {
                $error_message = 'Old password is incorrect.';
            }
        } else {
            $error_message = 'No account found with that email.';
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        /* Styling similar to other forms */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        .reset-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            color: #333;
        }
        .password-field {
            display: flex;
            align-items: center;
        }
        .form-group input {
            width: calc(100% - 30px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .btn-reset {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-reset:hover {
            background-color: #0056b3;
        }
        .show-password-icon {
            cursor: pointer;
            margin-left: 5px;
            color: #007bff;
            font-size: 18px;
        }
        .password-requirements{
            
            color: red;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <h2>Forgot Password</h2>

        <!-- Display Error Message -->
        <?php if (isset($error_message) && $error_message != '') { ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php } ?>

        <form method="POST" action="" onsubmit="return validateNewPassword()">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="old_password">Old Password</label>
                <div class="password-field">
                    <input type="password" id="old_password" name="old_password" required>
                    <i class="show-password-icon" onclick="togglePassword('old_password')">👁️</i>
                </div>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <div class="password-field">
                    <input type="password" id="new_password" name="new_password" required>
                    <i class="show-password-icon" onclick="togglePassword('new_password')">👁️</i>
                </div>
                <div id="passwordRequirements" class="password-requirements">
                    Password must be at least 8 characters long, with at least one uppercase letter, one lowercase letter, one digit, and one special character.
                </div>
            </div>
            <div class="form-group">
                <label for="confirm_new_password">Confirm New Password</label>
                <div class="password-field">
                    <input type="password" id="confirm_new_password" name="confirm_new_password" required>
                    <i class="show-password-icon" onclick="togglePassword('confirm_new_password')">👁️</i>
                </div>
            </div>
            <button type="submit" name="reset_password" class="btn-reset">Reset Password</button>
            <p>i will remember password <a href="login.php">Login</a></p>
        </form>
    </div>

    <script>
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const icon = passwordField.nextElementSibling;
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.textContent = "🙈";
            } else {
                passwordField.type = "password";
                icon.textContent = "👁️";
            }
        }

        // JavaScript password validation
        function validateNewPassword() {
            const newPassword = document.getElementById("new_password").value;
            const passwordRequirements = document.getElementById("passwordRequirements");

            // Validation pattern
            const isValidPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/.test(newPassword);

            if (!isValidPassword) {
                passwordRequirements.style.color = "red";
                return false; // Prevent form submission
            }

            passwordRequirements.style.color = "green";
            return true;
        }
    </script>
</body>
</html>
