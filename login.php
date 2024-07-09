<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "2626#26Vsl";
$database = "temple";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Include PHPMailer classes
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Function to generate OTP
function generateOTP() {
    return rand(100000, 999999); // Generates a 6-digit OTP
}

// Function to send OTP via email
function sendOTPEmail($email, $otp) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'leisuretech.agent'; // SMTP username
        $mail->Password = 'eoli mdgg wlsx fssc'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('your_email@example.com', 'Your Name');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = 'Your OTP code is: ' . $otp;

        $mail->send();
        echo '<div class="alert alert-success" role="alert">OTP has been sent to your email.</div>';
    } catch (Exception $e) {
        echo '<div class="alert alert-danger" role="alert">Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '</div>';
    }
}

// Function to check session expiration
function isSessionExpired($session_time) {
    $current_time = new DateTime();
    $session_time = new DateTime($session_time);
    $interval = $current_time->diff($session_time);
    return ($interval->i >= 10); // Check if 10 minutes have passed
}

// Check if the 'get_otp' button is clicked
$email = '';
if (isset($_POST['get_otp'])) {
    $email = $_POST['email'];

    // Check if email exists in the database
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row['session'] && !isSessionExpired($row['session'])) {
            // Session exists and is not expired
            echo '<div class="alert alert-danger" role="alert">You are already logged in from another device.</div>';
            echo '<form action="login.php" method="post" class="mt-3">
                    <input type="hidden" name="email" value="'.$email.'">
                    <button type="submit" name="logout_all" class="btn btn-danger">Logout from all devices</button>
                  </form>';
        } else {
            // Email exists, generate and send OTP
            $otp = generateOTP();

            // Store OTP in session (or database for more security)
            $_SESSION['otp'] = $otp;
            $_SESSION['email'] = $email;

            // Send OTP via email
            sendOTPEmail($email, $otp);
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Email does not exist.</div>';
    }
}

// Check if the 'login' button is clicked
if (isset($_POST['login'])) {
    $input_otp = $_POST['otp'];
    $email = $_SESSION['email'];

    // Verify the OTP
    if ($input_otp == $_SESSION['otp']) {
        // Update session column with current datetime
        $current_time = (new DateTime())->format('Y-m-d H:i:s');
        $stmt = $conn->prepare("UPDATE admin SET session = ? WHERE email = ?");
        $stmt->bind_param("ss", $current_time, $email);
        $stmt->execute();

        // Redirect to dashboard
        header('Location: dashboard/alerts.php');
        exit();
    } else {
        echo '<div class="alert alert-danger" role="alert">Invalid OTP.</div>';
    }
}

// Check if the 'logout_all' button is clicked
if (isset($_POST['logout_all'])) {
    $email = $_POST['email'];

    // Clear session column
    $stmt = $conn->prepare("UPDATE admin SET session = NULL WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    echo '<div class="alert alert-success" role="alert">Logged out from all devices. Please request a new OTP.</div>';
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Welcome to Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">home</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mt-5">Admin Login</h2>
                <form action="login.php" method="post" class="mt-3">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required value="<?php echo htmlspecialchars($email); ?>">
                    </div>
                    <button type="submit" name="get_otp" class="btn btn-primary">Get OTP</button>
                </form>

                <form action="login.php" method="post" class="mt-3">
                    <div class="form-group">
                        <label for="otp">OTP:</label>
                        <input type="text" id="otp" name="otp" class="form-control" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
Connection failed: Access denied for user 'root'@'localhost'