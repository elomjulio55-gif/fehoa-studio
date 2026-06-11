<?php

session_start();

require('../../connexionBD.php');

// Récupère les données du formulaire
$realisation_id = $_POST['realisation_id'] ?? '';
$note = $_POST['note'] ?? '';
$commentaire = $_POST['commentaire'] ?? '';




// Insertion
$stmt = $conn->prepare("INSERT INTO avis (realisation_id, note, commentaire) VALUES (?, ?, ?)");
$stmt->bind_param("ids", $realisation_id, $note, $commentaire);
$success = $stmt->execute();
if (!$success) {
    echo '<div style="...">❌ Une erreur s\'est produite lors de l\'ajout.</div>';
}

$req = $conn->prepare("SELECT prestataire.ID AS ID FROM prestataire, realisation, demande WHERE prestataire.ID = demande.prestataire_id AND demande.ID = realisation.demande_id AND realisation.ID = ?");
$req->bind_param("i", $realisation_id);
$success = $req->execute();
$res = $req->get_result();
$row = $res->fetch_assoc();
$prestataire_id = $row['ID'];

$req = $conn->prepare("SELECT prestataire.note_moyenne AS moy, COUNT(avis.ID) AS nbr_avis FROM prestataire, realisation, demande, avis WHERE prestataire.ID = demande.prestataire_id AND demande.ID = realisation.demande_id AND avis.realisation_id = realisation.ID AND prestataire.ID = ? GROUP BY prestataire.ID");
$req->bind_param("i", $prestataire_id);
$success = $req->execute();
$res = $req->get_result();
$row = $res->fetch_assoc();

if (!$success) {
    echo '<div style="...">❌ Une erreur s\'est produite</div>';
} else {
    $moy = $row['moy'];
    $nbr_avis = $row['nbr_avis'];
}

$moy = ($moy*$nbr_avis) /($nbr_avis+1);
$moy = round($moy * 2) / 2;

$stmt = $conn->prepare("UPDATE prestataire SET note_moyenne= ? WHERE ID= ?");
$stmt->bind_param("di", $moy, $prestataire_id);
$success = $stmt->execute();
if (!$success) {
    echo '<div style="...">❌ Une erreur s\'est produite</div>';
}
?>