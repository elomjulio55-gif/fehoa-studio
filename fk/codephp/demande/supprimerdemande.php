<?php

require('../connexionBD.php');

// Récupère les données du formulaire
$id = $_POST['id'] ?? '';

// Insertion
$stmt = $conn->prepare("DELETE FROM demande WHERE ID= ? ");
$stmt->bind_param("i", $id);
$success = $stmt->execute();
if (!$success) {
    echo '<div style="...">❌ Une erreur s\'est produite</div>';
}
?>