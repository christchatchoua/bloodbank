<?php
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get form data and sanitize it
    $nom = htmlspecialchars(trim($_POST['nom']));
    $age = (int) $_POST['age'];
    $genre = htmlspecialchars(trim($_POST['genre']));
    $groupe_sanguin = htmlspecialchars(trim($_POST['groupe-sanguin']));
    $telephone = htmlspecialchars(trim($_POST['telephone']));
    $region = htmlspecialchars(trim($_POST['region']));
    $adresse = htmlspecialchars(trim($_POST['adresse']));
    $conditions = htmlspecialchars(trim($_POST['conditions']));

    // Database connection variables
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bloodbank_db";

    // Create connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the SQL statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO donneurs (nom, groupe_sanguin, ville, telephone, email, date_derniere_don, disponible) VALUES (?, ?, ?, ?, ?, NULL, 1)");
    $stmt->bind_param("ssssss", $nom, $groupe_sanguin, $region, $telephone, $adresse);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Inscription réussie! Merci d'être un donneur de sang.";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
} else {
    echo "Aucune donnée reçue.";
}
?>
