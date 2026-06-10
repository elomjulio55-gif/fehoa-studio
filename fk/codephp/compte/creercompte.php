<?php
session_start();

require('../connexionBD.php');

// Récupère les données du formulaire
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
    // Hachage du mot de passe
    $motdepasse_hache = password_hash($motdepasse, PASSWORD_DEFAULT);

    // Insertion
    $stmt = $conn->prepare("INSERT INTO utilisateur (nom, prenom, email, motdepasse) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nom, $prenom, $email, $motdepasse_hache);
    $success = $stmt->execute();

    if ($success) {
        $id_nouvel_utilisateur = $conn->insert_id;

        $_SESSION['utilisateur_id'] = $id_nouvel_utilisateur;
        $_SESSION['nom'] = $nom;
        $_SESSION['email'] = $email;

        echo '<div style="...">✅ Utilisateur ajouté avec succès !</div>';
        exit();
    } else {
        echo '<div style="...">❌ Une erreur s\'est produite lors de l\'ajout.</div>';
        session_unset();
        session_destroy();
    }
}
if(type=="prestataire"){

    $specialite = $_POST['specialite'] ?? '';
    $adresse = $_POST['adresse'] ?? '';
    $ville = $_POST['ville'] ?? '';
    $disponibilite = $_POST['disponibilite'] ?? '';

    
    $stmt = $conn->prepare("INSERT INTO prestataire(`specialite`, `adresse`, `ville`, `disponibilite`) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nom, $prenom, $email, $motdepasse_hache);
    $success = $stmt->execute();
}
?>