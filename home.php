<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-title">
            <img src="../img/logo.jpg" alt="Logo" class="logo"> <!-- Add your logo here -->
            <h2>Personal CA</h2>
        </div>
        <div class="buttons">
            <a href="home.php">Home</a>
            <a href="fd/fd.php">FD</a>
            <a href="#page3">Loan</a>
            <a href="insurance/insurance.php">Insurance</a>
        </div>
        <a class="logout" href="logout.php">logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Welcome to the Tax Calculator</h1>

        <!-- Tax Calculator at the center -->
        <div class="tax-calculator">
            <form id="taxForm">
                <input type="number" id="age" placeholder="Age" required>
                <input type="number" id="income" placeholder="Annual Income" required>
                <input type="number" id="emi" placeholder="EMI" required>
                <input type="number" id="deductions" placeholder="Deductions" required>
                <input type="number" id="other" placeholder="Other" required>
                <button type="button" onclick="calculateTax()">Calculate Tax</button>
            </form>

            <div class="result">
                <p id="output"></p>
            </div>
        </div>
    </div>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <script src="home.js"></script>
</body>
</html>
