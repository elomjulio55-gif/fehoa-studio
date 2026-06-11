<?php

require('../connexionBD.php');

// Récupère les données du formulaire
$id = $_POST['id'] ?? '';

// Update
$stmt = $conn->prepare("UPDATE demande SET statut='annulee' WHERE ID= ?");
$stmt->bind_param("i", $id);
$success = $stmt->execute();
if (!$success) {
    echo '<div style="...">❌ Une erreur s\'est produite</div>';
}
?>