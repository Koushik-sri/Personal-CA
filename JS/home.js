function calculateTax() {
    const age = parseInt(document.getElementById('age').value);
    const income = parseInt(document.getElementById('income').value);
    const emi = parseInt(document.getElementById('emi').value);
    const deductions = parseInt(document.getElementById('deductions').value);
    const other = parseInt(document.getElementById('other').value);

    let taxableIncome = income - emi - deductions - other;
    let tax = 0;

    // Tax calculation based on old regime slabs
    if (age < 60) {
        if (taxableIncome <= 250000) {
            tax = 0;
        } else if (taxableIncome <= 500000) {
            tax = (taxableIncome - 250000) * 0.05;
        } else if (taxableIncome <= 1000000) {
            tax = 12500 + (taxableIncome - 500000) * 0.2;
        } else {
            tax = 112500 + (taxableIncome - 1000000) * 0.3;
        }
    } else if (age >= 60 && age < 80) {
        if (taxableIncome <= 300000) {
            tax = 0;
        } else if (taxableIncome <= 500000) {
            tax = (taxableIncome - 300000) * 0.05;
        } else if (taxableIncome <= 1000000) {
            tax = 10000 + (taxableIncome - 500000) * 0.2;
        } else {
            tax = 110000 + (taxableIncome - 1000000) * 0.3;
        }
    } else {
        if (taxableIncome <= 500000) {
            tax = 0;
        } else if (taxableIncome <= 1000000) {
            tax = (taxableIncome - 500000) * 0.2;
        } else {
            tax = 100000 + (taxableIncome - 1000000) * 0.3;
        }
    }

    document.getElementById('output').innerText = `Your estimated tax is: ₹${tax}`;
}
