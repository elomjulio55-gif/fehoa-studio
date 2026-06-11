<?php
session_start();

require('../connexionBD.php');

// Récupère les données du formulaire
$nom = $_POST['nom'] ?? '';
$prenom = $_POST['prenom'] ?? '';
$telephone = $_POST['telephone'] ?? '';
$email = $_POST['email'] ?? '';
$type = $_POST['type'] ?? '';


$stmt = $conn->prepare("UPDATE utilisateur SET nom = ?, prenom = ?, telephone = ?, email = ? WHERE ID= ?");
$stmt->bind_param("ssssi", $nom, $prenom, $telephone, $email, $_SESSION['utilisateur_id']);
$success = $stmt->execute();

if (!$success) {
    echo '<div style="...">❌ Une erreur s\'est produite</div>';
}
    
if($type=="prestataire"){

    $specialite = $_POST['specialite'] ?? '';
    $longitude = $_POST['longitude'] ?? '';
    $latitude = $_POST['latitude'] ?? '';
    $ville = $_POST['ville'] ?? '';
    $disponibilite = $_POST['disponibilite'] ?? '';

    
    $stmt = $conn->prepare("UPDATE prestataire SET specialite = ?, longitude = ?, latitude = ?, ville = ?, disponibilite = ? WHERE ID= ?");
    $stmt->bind_param("sddssi", $specialite, $longitude, $latitude, $email, $ville, $disponibilite, $_SESSION['utilisateur_id']);
    $success = $stmt->execute();
}
?>