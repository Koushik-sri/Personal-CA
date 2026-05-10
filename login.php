<?php
session_start();
require 'config.php'; // Your database configuration
require 'email_config.php'; // PHPMailer configuration

$error_message = "";
$success_message = "";

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email']; // Change from username to email
    $password = $_POST['password'];

    // Check if email and password are correct
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Successful login
            $_SESSION['username'] = $user['username']; // Save the username in session
            header("Location: home.php"); // Redirect to home page
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "User  does not exist.";
    }
    $stmt->close();
}

// Handle reset password form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset_password'])) {
    $email = $_POST['email'];
    $otp = rand(100000, 999999); // Generate a random OTP

    // Check if the email exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Send OTP to the email
        $_SESSION['otp'] = $otp;
        $_SESSION['reset_email'] = $email;
        $_SESSION['action'] = 'reset_password';

        $mail = setupMailer(); // Function to set up PHPMailer
        try {
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Your Password Reset OTP';
            $mail->Body = "Your OTP for resetting the password is: <strong>$otp</strong>";
            $mail->send();
            header("Location: verify_otp.php"); // Redirect to OTP verification page
            exit();
        } catch (Exception $e) {
            $error_message = "OTP could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $error_message = "This email is not registered.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css">
    <style>
        /* Add some basic styles for the modal */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 50%;
            top: 20%; /* Position it near the top */
            transform: translateX(-50%); /* Center horizontally */
            width: 300px; /* Set width of the modal */
            background-color: rgba(255, 255, 255, 0.95); /* Slightly transparent background */
            border: 1px solid #888;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            border-radius: 5px;
        }
        .modal-content {
            padding: 20px;
            text-align: center; /* Center text */
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover,
        .close:focus {
            color: black;
        }
    </style>
</head>
<body>
<form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <div class="button-container">
        <button type="submit" name="login">Login</button>
        <button type="button" onclick="toggleResetPassword();"> Reset Password</button>
    </div>
    <p class="account-question">
        Doesn't have an account? 
        <a href="register.php" class="reset-password-link">Register</a>
    </p>
</form>

<!-- Modal for error message -->
<div id="errorModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeErrorModal();">&times;</span>
        <p id="errorMessage"></p>
    </div>
</div>

<!-- Modal Overlay -->
<div id="modalOverlay" onclick="closeResetPassword();"></div>

<!-- Reset Password Modal -->
<div id="resetPasswordForm">
    <button class="close-btn" onclick="closeResetPassword();">&times;</button> <!-- Close Button -->
    <h3>Reset Password</h3>
    <form method="POST">
        <input type="email" name="email" placeholder="Enter your registered email" required>
        <button type="submit" name="reset_password">Send OTP</button>
    </form>
</div>

<script>
    function toggleResetPassword() {
        const modalOverlay = document.getElementById('modalOverlay');
        const resetForm = document.getElementById('resetPasswordForm');
        
        modalOverlay.style.display = 'block';
        resetForm.classList.add('show'); // Add show class for animation
    }

    function closeResetPassword() {
        const modalOverlay = document.getElementById('modalOverlay');
        const resetForm = document.getElementById('resetPasswordForm');

        modalOverlay.style.display = 'none';
        resetForm.classList.remove('show'); // Remove show class when closed
    }

    function showErrorModal(message) {
        const modal = document.getElementById('errorModal');
        const errorMessage = document.getElementById('errorMessage');
        errorMessage.innerText = message; // Set the error message
        modal.style.display = 'block'; // Show the modal
    }

    function closeErrorModal() {
        const modal = document.getElementById('errorModal');
        modal.style.display = 'none'; // Hide the modal
    }
</script>

<?php
// Display error message in the modal if there is an error
if (!empty($error_message)): ?>
    <script>
        showErrorModal(<?php echo json_encode($error_message); ?>);
    </script>
<?php endif; ?>

</body>
</html>