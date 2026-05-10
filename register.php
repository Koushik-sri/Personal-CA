<?php
session_start();
require 'config.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
$otp = rand(100000, 999999);
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match. Please try again.";
    } else {
        // Check if the username or email already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        $username_exists = false;
        $email_exists = false;

        // Loop through results to see which field exists
        while ($row = $result->fetch_assoc()) {
            if ($row['username'] === $username) {
                $username_exists = true;
            }
            if ($row['email'] === $email) {
                $email_exists = true;
            }
        }

        $stmt->close();

        if ($email_exists) {
            $error_message = "Email already exists. Please log in with your account.";
            echo "<script>alert('$error_message'); window.location.href = 'login.php';</script>";
        } elseif ($username_exists) {
            $error_message = "Username already exists. Please choose a different username.";
        } else {
            // Store user data temporarily in session variables
            $_SESSION['temp_username'] = $username;
            $_SESSION['temp_email'] = $email;
            $_SESSION['temp_password'] = password_hash($password, PASSWORD_DEFAULT);
            $_SESSION['otp'] = $otp;
            $_SESSION['action'] = 'register';

            // Send OTP to email
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'kdonthikurthi@gmail.com';
                $mail->Password = 'kjrb tpxj qrxm pmny'; // Replace with your actual app password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('no-reply@example.com', 'Your Name');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Your OTP for Registration';
                $mail->Body = "Your OTP is: <strong>$otp</strong>";

                $_SESSION['otp'] = $otp;
                $_SESSION['email'] = $email;
                $_SESSION['action'] = 'register';

                $mail->send();

                header("Location: verify_otp.php");
                exit();
            } catch (Exception $e) {
                echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="css/register.css">
    <script>
        // Validate passwords match
        function validateForm() {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirm_password").value;

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        }

        // Show error message if exists
        window.onload = function() {
            <?php if ($error_message && !$email_exists): ?>
                alert("<?php echo $error_message; ?>");
            <?php endif; ?>
        }
    </script>
</head>
<body>
    <div class="register-container">
        <form method="POST" onsubmit="return validateForm();">
            <h2>Register</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit" name="register">Register</button>
            
            <p class="login-link">Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>
</body>
</html>


                    