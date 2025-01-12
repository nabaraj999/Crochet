<?php
session_start();

if (isset($_GET['error']) && $_GET['error'] != null) {
    $error_message = $_GET['error'];
}


// Check if the user is already logged in
// if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
//     // header("location: dashboard.php");
//     exit;
// }

// include ('connection.php');
// if (isset($_POST['login'])) {
//     $email = $_POST['email'];
//     $password = $_POST['password'];

//     // Prepare and execute the statement
//     $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
//     $stmt->bind_param("s", $email);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $user = $result->fetch_assoc();

//     if ($user) {
//         // Verify the password
//         if (password_verify($password, $user['password'])) {
//             // Password is correct, start session or redirect
//             session_start();
//             $_SESSION['user_id'] = $user['id'];
//             $_SESSION["loggedin"] = true;
//             header("Location: ./dashboard.php");
//             exit;
//         } else {
//             $error_message = 'Invalid password. Please try again.';
//         }
//     } else {
//         $error_message = 'No account found with that email.';
//     }
//     $stmt->close();
// }
// $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
         .logo {
    font-size: 30px;
    font-weight: 700;
    color: #2c3e50;
    text-transform: uppercase;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}

        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
            position: relative;
            text-align: left;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            color: #333;
        }
        .form-group input {
            width: 95%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
            
        }
        .btn-login {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-login:hover {
            background-color: #0056b3;
        }
        .additional-links {
            text-align: center;
            margin-top: 20px;
        }
        .admin-user-links {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }
        .button-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .button-link:hover {
            background-color: #0056b3;
        }
    </style>
     <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <div class="logo">Crochet Learning
        </div>
        <h2>Sign In</h2>

        <?php if (isset($error_message) && $error_message != '') { ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php } ?>

        <form method="POST" action="login1.php">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <span class="toggle-password" onclick="togglePassword()">👁️</span>
            </div>
            <button type="submit" name="login" class="btn-login">Login</button>
        </form>

        <div class="additional-links">
            <a href="forgot_password.php">Forgot Password?</a>


            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const passwordToggle = document.querySelector(".toggle-password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                passwordToggle.textContent = "🙈";
            } else {
                passwordField.type = "password";
                passwordToggle.textContent = "👁️";
            }
        }
    </script>
</body>
</html>
