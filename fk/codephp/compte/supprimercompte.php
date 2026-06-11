<?php

session_start();

require('../connexionBD.php');

// Récupère les données du formulaire
$id = $_SESSION['utilisateur_id'] ?? '';

// Insertion
$stmt = $conn->prepare("DELETE FROM utilisateur WHERE ID= ? ");
$stmt->bind_param("i", $id);
$success = $stmt->execute();
if (!$success) {
    echo '<div style="...">❌ Une erreur s\'est produite</div>';
}
session_unset();
session_destroy();
?>