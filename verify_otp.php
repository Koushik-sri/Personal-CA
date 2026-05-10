<?php
session_start();
require 'config.php'; // Your database configuration

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_otp = $_POST['otp'];
    $action = $_SESSION['action']; // Assuming you set this when sending the OTP

    if ($input_otp == $_SESSION['otp']) {
        if ($action == 'register') {
            // OTP is correct for registration
            // Insert the user into the database
            $username = $_SESSION['temp_username'];
            $email = $_SESSION['temp_email'];
            $password = $_SESSION['temp_password'];

            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $password);

            if ($stmt->execute()) {
                $success_message = "Registration successful! You can now log in.";
                header("Location: login.php?message=" . urlencode($success_message));
                exit();
            } else {
                $error_message = "Error in registration: " . $stmt->error;
            }

            $stmt->close();
            session_unset(); // Clear session data
        } elseif ($action == 'reset_password') {
            // OTP is correct for resetting password
            $_SESSION['otp_verified'] = true;
            header("Location: update_password.php");
            exit();
        }
    } else {
        $error_message = "Invalid OTP. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="css/verify_otp.css">
</head>
<body>
    <div class="otp-container">
        <h3>OTP Verification</h3>
        <p>Please enter the OTP sent to your registered email.</p>
        <form method="POST">
            <input type="text" name="otp" placeholder="Enter OTP" required>
            <button type="submit">Verify OTP</button>
        </form>
        <?php if ($error_message): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
