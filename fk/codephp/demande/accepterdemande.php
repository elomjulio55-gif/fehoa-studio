<?php

session_start();

require('../connexionBD.php');

// Récupère les données du formulaire
$demande_id = $_POST['demande_id'] ?? '';
$date_debut = $_POST['date_debut'] ?? '';
$date_fin = $_POST['date_fin'] ?? '';

//Update statut de la demmande
$stmt = $conn->prepare("UPDATE demande SET statut='acceptee' WHERE ID= ?");
$stmt->bind_param("i", $demande_id);
$success = $stmt->execute();
if (!$success) {
    echo '<div style="...">❌ Une erreur s\'est produite</div>';
}

// Insertion dune realisationen attente
$stmt = $conn->prepare("INSERT INTO realisation (demande_id, date_debut, date_fin) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $demande_id, $date_debut, $date_fin);
$success = $stmt->execute();
if (!$success) {
    echo '<div style="...">❌ Une erreur s\'est produite lors de l\'ajout.</div>';
}
?>