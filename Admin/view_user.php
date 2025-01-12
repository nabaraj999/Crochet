<?php
// Start session and include database connection
session_start();
include '../connection/connection.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../Login/login.php");
    exit();
}

// Get user ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch user details
$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "<p>User not found.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View User Details</title>
    <style>
        .cv-container {
            width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h3 {
            color: #4CAF50;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
        }
        .section p {
            margin: 8px 0;
            font-size: 14px;
            color: #555;
        }
        img.profile-photo {
            display: block;
            margin: 0 auto 20px;
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
        .download-btn {
            display: block;
            margin: 20px auto;
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
            font-size: 16px;
        }
        .download-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="cv-container" id="cv-content">
<img src="<?php echo !empty($user['avatar']) ? '../uploads/' . htmlspecialchars($user['avatar']) : '../uploads/default-avatar.png'; ?>" alt="User Avatar" style="width:150px; height:150px; border-radius:50%; margin-left:200px;">
    
    <h2>User Details</h2>

    <div class="section">
        <h3>Personal Details</h3>
        <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
        <p><strong>District:</strong> <?php echo htmlspecialchars($user['district']); ?></p>
        <p><strong>Municipality:</strong> <?php echo htmlspecialchars($user['municipality']); ?></p>
        <p><strong>Ward No:</strong> <?php echo htmlspecialchars($user['ward_no']); ?></p>
        <p><strong>Job Type:</strong> <?php echo htmlspecialchars($user['job_type']); ?></p>
        <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
    </div>

    <div class="section">
        <h3>Educational Details</h3>
        <p><strong>College Name:</strong> <?php echo htmlspecialchars($user['college_name']); ?></p>
        <p><strong>Level:</strong> <?php echo htmlspecialchars($user['level']); ?></p>
        <p><strong>Subject:</strong> <?php echo htmlspecialchars($user['subject']); ?></p>
        <p><strong>Company Name:</strong> <?php echo htmlspecialchars($user['company_name']); ?></p>
        <p><strong>Post:</strong> <?php echo htmlspecialchars($user['post']); ?></p>
    </div>
</div>

<!-- Button to trigger PDF download -->
<button class="download-btn" onclick="downloadCV()">Download CV</button>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script>
    function downloadCV() {
        const element = document.getElementById('cv-content');
        const options = {
            margin: 0,
            filename: '<?php echo htmlspecialchars($user['username']); ?>_CV.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { format: 'a4', orientation: 'portrait' }
        };

        html2pdf().from(element).set(options).save();
    }
</script>

</body>
</html>
