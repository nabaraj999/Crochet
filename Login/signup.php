<?php
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
$error_message = ''; // Initialize an empty error message

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error_message = 'Passwords do not match. Please try again.';
    } else {
        // Check if the email already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error_message = 'An account with that email already exists.';
        } else {
            // If email is unique, insert the user data into the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                header("Location: login.php"); // Redirect to login page
                exit;
            } else {
                $error_message = 'Error: Could not register. Please try again.';
            }
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
    <title>Sign Up</title>
    <style>

.logo {
    font-size: 30px;
    font-weight: 700;
    color: #2c3e50;
    text-transform: uppercase;

    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}


        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        .signup-container {
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
            position: relative; /* Position relative to align icon inside input */
            margin-bottom: 15px;
            text-align: left;
            width: 350px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            color: #333;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            padding-right: 35px; /* Adjust for icon */
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .toggle-password {
            position: absolute;
            right: -20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: #007bff;
            cursor: pointer;
            display: inline-block;
        }
        .toggle-password i {
            font-style: normal; /* For icon */
        }
        .error, .success {
            font-size: 14px;
            margin-top: 5px;
        }
        .error { color: red; }
        .success { color: green; }
        .btn-signup {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-signup:hover {
            background-color: #0056b3;
        }
        .login-link {
    display: inline-block;
    font-size: 14px;
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
    margin-left: auto;
    margin-top: 2px;
    margin-right: 25px;
    text-align: right;
    float: right;
}

.already-account {
    overflow: hidden;
}


.login-link:hover {
    text-decoration: underline;
    color: #0056b3; /* Darker shade for hover effect */
}

.already-account {
    display: inline; /* keeps everything on the same line */
    font-size: 14px; /* adjust font size as needed */
}

    </style>
</head>
<body>
    <div class="signup-container">
    <div class="logo">Crochet Learning
    </div>
        <h2>Sign Up</h2>

        <!-- Display Error Message -->
        <?php if (!empty($error_message)) { ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php } ?>

        <form method="POST" action="" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required oninput="validateUsername()">
                <div id="usernameMessage" class="error"></div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required oninput="validateEmail()">
                <div id="emailMessage" class="error"></div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required oninput="validatePassword()">
                <span class="toggle-password" onclick="togglePassword('password')">
                    <i id="passwordToggleIcon">👁️</i>
                </span>
                <div id="passwordMessage" class="error"></div>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required oninput="validateConfirmPassword()">
                <span class="toggle-password" onclick="togglePassword('confirm_password')">
                    <i id="confirmPasswordToggleIcon">👁️</i>
                </span>
                <div id="confirmPasswordMessage" class="error"></div>
            </div>
            <button type="submit" name="signup" class="btn-signup">Sign Up</button>
        </form>
        
        <p>I already have an account <a href="login.php">Login</a></p>


    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.querySelector("i");

            if (field.type === "password") {
                field.type = "text";
                icon.textContent = "🙈"; // Change icon to 'hide'
            } else {
                field.type = "password";
                icon.textContent = "👁️"; // Change icon to 'show'
            }
        }

        function validateUsername() {
            const username = document.getElementById("username").value;
            const usernameMessage = document.getElementById("usernameMessage");
            const isValidUsername = /^[a-zA-Z0-9]{8,20}$/.test(username);

            if (!isValidUsername) {
                usernameMessage.textContent = "Username must be 8-20 alphanumeric characters.";
                return false;
            } else {
                usernameMessage.textContent = "";
                return true;
            }
        }

        function validateEmail() {
            const email = document.getElementById("email").value;
            const emailMessage = document.getElementById("emailMessage");
            const isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

            if (!isValidEmail) {
                emailMessage.textContent = "Please enter a valid email address.";
                return false;
            } else {
                emailMessage.textContent = "";
                return true;
            }
        }

        function validatePassword() {
            const password = document.getElementById("password").value;
            const passwordMessage = document.getElementById("passwordMessage");
            const isValidPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/.test(password);

            if (!isValidPassword) {
                passwordMessage.textContent = "Password must be at least 8 characters long, contain uppercase, lowercase, digit, and special character.";
                return false;
            } else {
                passwordMessage.textContent = "";
                return true;
            }
        }

        function validateConfirmPassword() {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirm_password").value;
            const confirmPasswordMessage = document.getElementById("confirmPasswordMessage");

            if (password !== confirmPassword) {
                confirmPasswordMessage.textContent = "Passwords do not match.";
                return false;
            } else {
                confirmPasswordMessage.textContent = "";
                return true;
            }
        }

        function validateForm() {
            return validateUsername() && validateEmail() && validatePassword() && validateConfirmPassword();
        }
    </script>
</body>
</html>
