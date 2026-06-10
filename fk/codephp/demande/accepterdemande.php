<?php

session_start();

require('../connexionBD.php');

// Récupère les données du formulaire
$demande_id = $_SESSION['demande_id'] ?? '';
$date_debut = $_POST['date_debut'] ?? '';
$date_fin = $_POST['date_fin'] ?? '';


// Insertion
$stmt = $conn->prepare("INSERT INTO realisation (demande_id, date_debut, date_fin) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $demande_id, $date_debut, $date_fin);
$success = $stmt->execute();
if (!$success) {
    echo '<div style="...">❌ Une erreur s\'est produite lors de l\'ajout.</div>';
}
?>
