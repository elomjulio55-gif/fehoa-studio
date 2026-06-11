<?php

require('../connexionBD.php');

// Récupère les données du formulaire
$id = $_SESSION['id'] ?? '';

// Insertion
$stmt = $conn->prepare("UPDATE demande SET status='annulee' WHERE ID= ?");
$stmt->bind_param("i", $id);
$success = $stmt->execute();
if (!$success) {
    echo '<div style="...">❌ Une erreur s\'est produite</div>';
}
?>