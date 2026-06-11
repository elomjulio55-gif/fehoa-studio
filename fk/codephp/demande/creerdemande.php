<?php

session_start();

require('../connexionBD.php');

// Récupère les données du formulaire
$client_id = $_SESSION['client_id'] ?? '';
$prestataire_id = $_POST['prestataire_id'] ?? '';
$description = $_POST['description'] ?? '';
$budjet = $_POST['budjet'] ?? '';
$longitude = $_POST['longitude'] ?? '';
$latitude = $_POST['latitude'] ?? '';
$date_souhaitee = $_POST['date_souhaitee'] ?? '';



// Insertion
$stmt = $conn->prepare("INSERT INTO demande (client_id, prestataire_id, description, budjet, longitude, latitude, date_souhaitee) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssddds", $client_id, $prestataire_id, $description,$budjet, $longitude, $latitude, $date_souhaitee);
$success = $stmt->execute();
if (!$success) {
    echo '<div style="...">❌ Une erreur s\'est produite lors de l\'ajout.</div>';
}
?>