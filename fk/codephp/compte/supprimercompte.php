<?php

require('../connexionBD.php');

// Récupère les données du formulaire
$id = $_SESSION['id'] ?? '';

// Insertion
$stmt = $conn->prepare("DELETE FROM utilisateur WHERE ID= ? ");
$stmt->bind_param("s", $id);
$success = $stmt->execute();
if (!$success) {
    echo '<div style="...">❌ Une erreur s\'est produite</div>';
}
?>
