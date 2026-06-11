<?php
session_start(); // ⚡ Démarre la session

require('../connexionBD.php');


$precedant_mot_de_passe= $_POST['precedant_mot_de_passe'] ?? '';
$nouveau_mot_de_passe = $_POST['nouveau_mot_de_pass'] ?? '';

$req = $conn->prepare("SELECT * FROM utilisateur WHERE ID = ?");
$req->bind_param("i", $_SESSION['utilisateur_id']);
$success = $req->execute();
$res = $req->get_result();
$row = $res->fetch_assoc();
if (!$success) {
    echo '<div style="...">❌ Une erreur s\'est produite</div>';
}


if ($row) {
    if (password_verify($precedant_mot_de_passe, $row['mot_de_passe'])) {
        $motdepasse_hache = password_hash($nouveau_mot_de_passe, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE mot_de_passe = ? WHERE ID= ?");
        $stmt->bind_param("ssssi", $motdepasse_hache, $_SESSION['utilisateur_id']);
        $success = $stmt->execute();

        if (!$success) {
            echo '<div style="...">❌ Une erreur s\'est produite</div>';
        }
    }
}