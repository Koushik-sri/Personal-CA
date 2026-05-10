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
    <link rel="stylesheet" href="../css/fd.css">
    <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<body>
    <div class="sidebar">
        <div class="logo-title">
            <img src="../img/logo.jpg" alt="Logo" class="logo">
            <h2>Personal CA</h2>
        </div>
        <div class="buttons">
            <a href="../home.php">Home</a>
            <a href="fd.php">FD</a>
            <a href="">Loan</a>
            <a href="../insurance/insurance.php">Insurance</a>
        </div>
        <a class="quit" href="../logout.php">logout</a>
    </div>

    <div class="bank-list">
        <div class="bank-box" onclick="showDetails('HDFC Bank')">HDFC</div>
        <div class="bank-box" onclick="showDetails('ICICI Bank')">ICICI</div>
        <div class="bank-box" onclick="showDetails('SBI Bank')">SBI</div>
        <div class="bank-box" onclick="showDetails('Axis Bank')">Axis</div>
        <div class="bank-box" onclick="showDetails('Bank of Baroda')">BOB</div>
        <div class="bank-box" onclick="showDetails('RBL Bank')">RBL</div>
    </div>

    <div class="fd-calculator">
        <h2>FD Interest Rate Calculator</h2>
        <div class="calculator-inputs">
            <input type="number" id="amount" placeholder="Enter amount">
            <input type="number" id="rate" placeholder="Enter interest rate (%)">
            <input type="number" id="tenure" placeholder="Enter tenure (years)">
            <button onclick="calculateInterest()"><b>Calculate Interest</b></button>
            <div class="result">
                <p id="output"></p>
            </div>
        </div>
    </div>

    <div class="background-text">FD Calculator</div>

    <!-- Popup for FD details -->
    <div id="fd-details-popup" class="fd-details-popup">
        <div class="fd-details-content">
            <span class="close" onclick="closeDetails()">&times;</span>
            <h2 id="bank-name">Bank FD Rates</h2>
            <p id="fd-details">Interest rates and details will be displayed here.</p>
        </div>
    </div>

    <script src="../JS/fd.js"></script>
</body>
</html>
