<?php
// Database connection variables
$servername = "localhost";  // XAMPP default is localhost
$username = "root";         // Default MySQL user in XAMPP
$password = "";             // XAMPP has no default password for MySQL
$dbname = "bloodbank_db";    // Name of your database

// Create connection to MySQL server
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to MySQL<br>";

// Create the database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully or already exists<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db($dbname);

// SQL to create the 'donneurs' table
$sql = "CREATE TABLE IF NOT EXISTS donneurs (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    groupe_sanguin VARCHAR(3) NOT NULL,
    ville VARCHAR(100) NOT NULL,
    telephone VARCHAR(15),
    email VARCHAR(100),
    date_derniere_don DATE,
    disponible BOOLEAN DEFAULT 1,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

// Execute the query to create the table
if ($conn->query($sql) === TRUE) {
    echo "Table 'donneurs' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close the connection
$conn->close();
?>
