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
    <link rel="stylesheet" href="../css/Insurance.css">
    <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-title">
            <img src="../img/logo.jpg" class="logo" alt="Logo"> <!-- Replace with your logo image -->
            <h3>Personal CA</h3>
        </div>
        <div class="buttons">
            <a href="../home.php">Home</a>
            <a href="../fd/fd.php">FD</a>
            <a href="">Loan</a>
            <a href="insurance.php">Insurance</a>
        </div>
        <div class="quit-button">
            <a class="logout" href="../logout.php">logout</a>
        </div>
    </div>

    <!-- Toggle Button for Switching Insurance Types -->
    <div class="toggle-section">
        <label class="switch">
            <input type="checkbox" id="toggle-insurance">
            <span class="slider round"></span>
        </label>
        <p id="toggle-text">Vehicle Insurance</p>
    </div>

    <!-- Container for Insurance Policies -->
    <div class="insurance-container" id="insurance-container">
        <!-- Vehicle Insurance -->
        <div class="insurance-box" style="border-radius: 20px;">
            <div class="company-info" >
                <img src="../img/hdfc.png" alt="Company Logo" style="border-radius: 20px;">
                <div>
                    <h3>HDFC Car Insurance</h3>
                    <p>Comprehensive cover, personal accident, zero depreciation.</p>
                </div>
            </div>
            <div class="payment">
                <div>Monthly: ₹1,500</div>
                <div>Yearly: ₹16,000</div>
            </div>
        </div>

        <div class="insurance-box" style="border-radius: 20px;">
            <div class="company-info" style="border-radius: 20px;">
                <img src="company2.png" alt="Company Logo">
                <div>
                    <h3>Bajaj Allianz Vehicle Insurance</h3>
                    <p>Third-party coverage, no-claim bonus, personal accident cover.</p>
                </div>
            </div>
            <div class="payment">
                <div>Monthly: ₹1,200</div>
                <div>Yearly: ₹13,500</div>
            </div>
        </div>
    </div>

    <!-- Hidden Container for Health Insurance -->
    <div class="insurance-container" id="health-container" style="display: none;">
        <!-- Health Insurance -->
        <div class="insurance-box" style="border-radius: 20px;">
            <div class="company-info">
                <img src="company3.png" alt="Company Logo">
                <div>
                    <h3>Max Bupa Health Companion</h3>
                    <p>Coverage up to ₹5 lakh, maternity benefits, annual health check-up.</p>
                </div>
            </div>
            <div class="payment">
                <div>Monthly: ₹2,200</div>
                <div>Yearly: ₹25,500</div>
            </div>
        </div>

        <div class="insurance-box" style="border-radius: 20px;">
            <div class="company-info">
                <img src="company4.png" alt="Company Logo">
                <div>
                    <h3>Star Health Senior Citizens Plan</h3>
                    <p>Pre-existing disease cover, senior citizens specific, cashless hospitalization.</p>
                </div>
            </div>
            <div class="payment">
                <div>Monthly: ₹2,800</div>
                <div>Yearly: ₹30,500</div>
            </div>
        </div>
    </div>

    
    <script>
        const toggleSwitch = document.getElementById('toggle-insurance');
        const insuranceContainer = document.getElementById('insurance-container');
        const healthContainer = document.getElementById('health-container');
        const toggleText = document.getElementById('toggle-text');

        toggleSwitch.addEventListener('change', function() {
            if (this.checked) {
                toggleText.innerText = 'Health Insurance';
                insuranceContainer.style.display = 'none';
                healthContainer.style.display = 'block';

                healthContainer.style.animation = 'slideIn 0.5s ease-in-out'; // Animation for health policies
            } else {
                toggleText.innerText = 'Vehicle Insurance';
                healthContainer.style.display = 'none';
                insuranceContainer.style.display = 'block';

                insuranceContainer.style.animation = 'slideIn 0.5s ease-in-out'; // Animation for vehicle policies
            }
        });

        // CSS for Slide Animation
        const styleElem = document.createElement('style');
        styleElem.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
        `;
        document.head.appendChild(styleElem);
    </script>
</body>
</html>
