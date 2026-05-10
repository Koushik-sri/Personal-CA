<?php
session_start();
require 'config.php'; // Your database configuration

$error_message = "";
$success_message = "";

// Handle password reset
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the new password and confirm password match
    if ($new_password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        $email = $_SESSION['reset_email'];

        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashed_password, $email);
        if ($stmt->execute()) {
            $success_message = "Password has been reset successfully.";
            // Optionally, redirect to login page or home page
            echo "<script>setTimeout(function() { window.location.href = 'login.php'; }, 2000);</script>"; // Redirect after 2 seconds
        } else {
            $error_message = "Failed to reset password. Please try again.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/reset.css">
</head>
<body>
<div class="container">
        <h3>Reset Password</h3>
        <form method="POST">
        <input type="password" name="new_password" placeholder="Enter new password" required>
        <input type="password" name="confirm_password" placeholder="Confirm new password" required>
        <button type="submit" name="reset_password">Reset Password</button>
    </form>

    <?php if (!empty($error_message)): ?>
        <div class="error-message">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($success_message)): ?>
        <div class="success-message" id="successModal">
            <span class="close" onclick="closeModal();">&times;</span>
            <p><?php echo $success_message; ?></p>
        </div>
        <script>
            document.getElementById('successModal').style.display = 'block'; // Show the modal
        </script>
    <?php endif; ?>

    <script>
        function closeModal() {
            window.location.href = 'login.php'; // Redirect to login page
        }
    </script>
</body>
</html>