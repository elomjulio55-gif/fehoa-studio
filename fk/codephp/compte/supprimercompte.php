<?php

require(connexionBD.php);

$idutilisateur = $_GET['id'] ?? null;
if (!$idutilisateur) {
    echo "id du utilisateur non spécifié.";
    exit;
}

// Vérifier si le utilisateur existe
$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE idutilisateur = :id");
$stmt->execute(['id' => $idutilisateur]);
$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$utilisateur) {
    echo "utilisateur introuvable.";
    exit;
}

// Supprimer le utilisateur
$stmt = $pdo->prepare("DELETE FROM commandes WHERE idclient = :id");
$stmt->execute(['id' => $idutilisateur]);

$stmt = $pdo->prepare("DELETE FROM panier WHERE idclient = :id");
$stmt->execute(['id' => $idutilisateur]);

$stmt = $pdo->prepare("DELETE FROM favoris WHERE idclient = :id");
$stmt->execute(['id' => $idutilisateur]);

$stmt = $pdo->prepare("DELETE FROM utilisateurs WHERE idutilisateur = :id");
$stmt->execute(['id' => $idutilisateur]);
        echo '<script>
           
                    window.location.href = "http://localhost/projetboutiqueV2/admin.php";
         
              </script>';
?>