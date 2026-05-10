// FD interest rates for different banks
const bankFDData = {
    "HDFC Bank": {
        "1 Year": "5.5%",
        "2 Years": "6.0%",
        "3 Years": "6.5%",
        "5 Years": "7.0%"
    },
    "ICICI Bank": {
        "1 Year": "5.7%",
        "2 Years": "6.2%",
        "3 Years": "6.7%",
        "5 Years": "7.1%"
    },
    "SBI Bank": {
        "1 Year": "5.6%",
        "2 Years": "6.1%",
        "3 Years": "6.6%",
        "5 Years": "7.2%"
    },
    "Axis Bank": {
        "1 Year": "5.8%",
        "2 Years": "6.3%",
        "3 Years": "6.8%",
        "5 Years": "7.3%"
    },
    "Bank of Baroda": {
        "1 Year": "5.4%",
        "2 Years": "6.0%",
        "3 Years": "6.4%",
        "5 Years": "7.0%"
    },
    "RBL Bank": {
        "1 Year": "6.0%",
        "2 Years": "6.5%",
        "3 Years": "7.0%",
        "5 Years": "7.5%"
    }
};

// Function to show details for a selected bank
function showDetails(bank) {
    const fdPopup = document.getElementById('fd-details-popup');
    const bankName = document.getElementById('bank-name');
    const fdDetails = document.getElementById('fd-details');

    // Get the FD rates for the selected bank
    const interestRates = bankFDData[bank];

    // Build the FD details content
    let fdRatesContent = "";
    for (const tenure in interestRates) {
        fdRatesContent += `${tenure}: ${interestRates[tenure]}\n`;
    }

    // Set the content in the popup
    bankName.innerText = `${bank} FD Rates`;
    fdDetails.innerText = fdRatesContent;

    // Show the popup
    fdPopup.style.display = 'block';
}

// Function to close the FD details popup
function closeDetails() {
    const fdPopup = document.getElementById('fd-details-popup');
    fdPopup.style.display = 'none'; // Hide the popup
}

// Function to calculate interest based on input fields
function calculateInterest() {
    const amount = document.getElementById('amount').value;
    const rate = document.getElementById('rate').value;
    const tenure = document.getElementById('tenure').value;

    if (amount && rate && tenure) {
        const interest = (amount * rate * tenure) / 100;
        document.getElementById('output').innerText = `Interest: ₹${interest}`;
    } else {
        document.getElementById('output').innerText = 'Please fill all fields';
    }
}
