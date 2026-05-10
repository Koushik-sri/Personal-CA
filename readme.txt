Creating a login and registration page with OTP authentication using PHP involves several steps, including setting up your environment, creating the database, writing the PHP scripts, and designing the frontend with HTML and CSS. Below, I’ll guide you through the entire process step by step.

Step 1: 
Set Up Your Environment
Install a Local Server: Use software like XAMPP.Start the Server: Launch the XAMPP control panel and start the Apache and MySQL services.
Install composer and Git 

Step 2: 
Create the Database
Open phpMyAdmin: Access it via http://localhost/phpmyadmin.
Create a Database: Click on "Databases" and create a new database with anyname.
Create a Users Table: Run the following SQL command to create the users table:
(here i used databse named trail) you can change it in config.php
code:

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    is_verified TINYINT(1) DEFAULT 0
);


Step 3: 
Create the Project Structure
inside xampp folder in lockdisk c create a new folder in htdocs and add these files

step 4:
after this open your browser type

http://localhost/my_project/filename.php



for OTP feature to work open the directory and open cmd and type the command
" composer require phpmailer/phpmailer "




reference:
https://chatgpt.com/share/671df89e-9308-8013-a6e8-7c128d308569
https://chatgpt.com/share/671df8ca-cfbc-8013-88d4-7be6fac80dbb