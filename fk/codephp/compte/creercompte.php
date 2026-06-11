<?php
session_start();

require('../connexionBD.php');

$nom = $_POST['nom'] ?? '';
$prenom = $_POST['prenom'] ?? '';
$telephone = $_POST['telephone'] ?? '';
$email = $_POST['email'] ?? '';
$motdepasse = $_POST['mot_de_passe'] ?? '';
$type = $_POST['type'] ?? '';

// Vérifie si l'email ou le nom existe déjà
$stmt = $conn->prepare("SELECT * FROM utilisateur WHERE email = ? OR nom = ?");
$stmt->bind_param("ss", $email, $nom);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();

if ($row) {
    echo '<div style="...">⚠️ Cet email ou nom déjà enregistré. Veuillez en utiliser un autre.</div>';
} else {
    $motdepasse_hache = password_hash($motdepasse, PASSWORD_DEFAULT);

    // Photo de profil
    $chemin_photo = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $dossier = '../uploads/profils/';
        if (!is_dir($dossier)) mkdir($dossier, 0777, true);

        $extensions_autorisees = ['jpg', 'jpeg', 'png', 'webp'];
        $extension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

        if (in_array($extension, $extensions_autorisees)) {
            $nom_fichier = uniqid() . '.' . $extension;
            $chemin_photo = $dossier . $nom_fichier;
            if (!move_uploaded_file($_FILES['photo']['tmp_name'], $chemin_photo)) {
                $chemin_photo = null;
            }
        }
    }

    $stmt = $conn->prepare("INSERT INTO utilisateur (nom, prenom, telephone, email, mot_de_passe, photo_profil) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nom, $prenom, $telephone, $email, $motdepasse_hache, $chemin_photo);
    $success = $stmt->execute();

    if ($success) {
        $id_nouvel_utilisateur = $conn->insert_id;

        $_SESSION['utilisateur_id'] = $id_nouvel_utilisateur;
        $_SESSION['nom'] = $nom;
        $_SESSION['email'] = $email;

        if ($type == "prestataire") {
            $specialite = $_POST['specialite'] ?? '';
            $longitude = $_POST['longitude'] ?? '';
            $latitude = $_POST['latitude'] ?? '';
            $ville = $_POST['ville'] ?? '';
            $disponibilite = $_POST['disponibilite'] ?? '';

            $stmt = $conn->prepare("INSERT INTO prestataire (ID, specialite, longitude, latitude, ville, disponibilite) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isddss", $id_nouvel_utilisateur, $specialite, $longitude, $latitude, $ville, $disponibilite);
            $success = $stmt->execute();

            if (!$success) {
                echo '<div style="...">❌ Erreur lors de la création du profil prestataire.</div>';
            }
        }

        echo '<div style="...">✅ Utilisateur ajouté avec succès !</div>';
    } else {
        echo '<div style="...">❌ Une erreur s\'est produite lors de l\'ajout.</div>';
        session_unset();
        session_destroy();
    }
}
?>