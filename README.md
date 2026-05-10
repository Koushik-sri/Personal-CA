# Personal CA - Financial Management System

Personal CA is a web-based financial toolkit acting as your personal chartered accountant. Built with PHP, HTML, CSS, and JavaScript, it provides essential financial calculators and a directory of financial products (FDs, Insurance) wrapped in a secure, authenticated environment.

## 🚀 Key Features

* **Secure User Authentication**: Robust login and registration system featuring email OTP verification using PHPMailer.
* **Tax Calculator**: Instantly calculate your taxes by inputting your age, annual income, EMIs, and deductions.
* **Fixed Deposit (FD) Calculator**: Check and compare interest rates across various top banks (HDFC, ICICI, SBI, Axis, etc.) and calculate your returns based on tenure.
* **Insurance Portal**: An interactive portal to browse and compare different Vehicle and Health Insurance policies and their monthly/yearly premiums.

## 🛠️ Tech Stack

* **Frontend**: HTML5, CSS3, Vanilla JavaScript
* **Backend**: PHP
* **Database**: MySQL
* **Dependencies**: Composer, PHPMailer (for OTP email services)

## ⚙️ Installation & Setup

Follow these steps carefully to run this project on your local machine.

### 1. Prerequisites
* Install **XAMPP** (or any other local server with PHP and MySQL).
* Install **Composer** (PHP dependency manager).

### 2. Clone the Repository
Clone this project into your `htdocs` directory (e.g., `C:\xampp\htdocs\`).
```bash
git clone https://github.com/Koushik-sri/Personal-CA.git Fin
cd Fin
```

### 3. Database Setup
1. Open your browser and go to `http://localhost/phpmyadmin`.
2. Create a new database named `trail` (or change the name, but you must update `config.php` accordingly).
3. Run the following SQL query in phpMyAdmin to create the `users` table:
   ```sql
   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(50) NOT NULL UNIQUE,
       email VARCHAR(100) NOT NULL UNIQUE,
       password VARCHAR(255) NOT NULL,
       is_verified TINYINT(1) DEFAULT 0
   );
   ```

### 4. Configuration (Important!)

Before running the application, you **must** configure your database and email settings.

#### A. Database Configuration (`config.php`)
Open `config.php` and update the database credentials if necessary. If you are using default XAMPP settings, the default configuration should work:
```php
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = "";     // Your MySQL password
$dbname = "trail";  // Your Database name
```

#### B. Email Setup for OTP (`email_config.php`)
This application uses PHPMailer to send OTP verification emails. 
1. Open `email_config.php`.
2. Locate the following lines and add your own Gmail credentials:
   ```php
   $mail->Username = 'your_email@gmail.com'; // Add your Gmail Address here
   $mail->Password = 'your_app_password';    // Add your 16-character App Password here
   ```
   **Note on Gmail App Passwords:** You cannot use your normal Gmail password. You must go to your Google Account Settings > Security > 2-Step Verification and create an **App Password** to use in the code.

### 5. Install Dependencies
Open your terminal inside the project folder (`C:\xampp\htdocs\Fin`) and install the required PHPMailer dependency by running:
```bash
composer install
# (If composer.json is not set up correctly, run: composer require phpmailer/phpmailer)
```

### 6. Run the App
Open your browser and navigate to:
```
http://localhost/Fin/login.php
```
You can now register a new account, verify your OTP, and explore the Personal CA tools!
