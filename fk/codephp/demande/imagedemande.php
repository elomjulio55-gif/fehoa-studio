<?php
session_start();
require('../../connexionBD.php');

$demande_id = $_POST['demande_id'] ?? '';
$dossier = '../../images/demandes/';

if (!is_dir($dossier)) mkdir($dossier, 0777, true);

$extensions_autorisees = ['jpg', 'jpeg', 'png', 'webp'];

for ($i = 0; $i < count($_FILES['photos']['name']); $i++) {
    if ($_FILES['photos']['error'][$i] !== 0) continue;

    $extension = strtolower(pathinfo($_FILES['photos']['name'][$i], PATHINFO_EXTENSION));

    if (!in_array($extension, $extensions_autorisees)) {
        echo "❌ Extension non autorisée : " . $_FILES['photos']['name'][$i];
        continue;
    }

    $nom_fichier = uniqid() . '.' . $extension;
    $chemin = $dossier . $nom_fichier;

    if (move_uploaded_file($_FILES['photos']['tmp_name'][$i], $chemin)) {
        $stmt = $conn->prepare("INSERT INTO photo_demande (demande_id, lien_photo) VALUES (?, ?)");
        $stmt->bind_param("is", $demande_id, $chemin);
        $stmt->execute();
    } else {
        echo "❌ Échec du téléchargement de " . $_FILES['photos']['name'][$i];
    }
}
echo "✅ Photos ajoutées";
?>