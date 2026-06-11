<?php

require('../connexionBD.php');

// Récupère les données du formulaire
$id = $_SESSION['id'] ?? '';

// Update
$stmt = $conn->prepare("UPDATE demande SET status='refusee' WHERE ID= ?");
$stmt->bind_param("i", $id);
$success = $stmt->execute();
if (!$success) {
    echo '<div style="...">❌ Une erreur s\'est produite</div>';
}
?>