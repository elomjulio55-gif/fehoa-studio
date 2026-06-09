<?php
session_start(); // ⚡ Démarre la session

// Connexion à la base PostgreSQL
try {
    $conn = new PDO("pgsql:host=localhost;dbname=sitedevente", "postgres", "raymond2008");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupère les données du formulaire
$pseudo = $_POST['pseudo'] ?? '';
$email = $_POST['email'] ?? '';
$motdepasse = $_POST['mot_de_passe'] ?? '';

// Vérifie si l'email ou le pseudo existe déjà
$stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE email = :email OR pseudo = :pseudo");
$stmt->execute(['email' => $email, 'pseudo' => $pseudo]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
        echo '<div style="...">⚠️ Cet email ou pseudo déjà enregistré. Veuillez en utiliser un autre.</div>';
} else {

    // Hachage du mot de passe
    $motdepasse_hache = password_hash($motdepasse, PASSWORD_DEFAULT);

    // Insertion
    $stmt = $conn->prepare("INSERT INTO utilisateurs (pseudo, email, motdepasse) VALUES (:pseudo, :email, :motdepasse)");
    $success = $stmt->execute([
        'pseudo' => $pseudo,
        'email' => $email,
        'motdepasse' => $motdepasse_hache
    ]);

    if ($success) {
        // Récupère l'ID inséré
        $id_nouvel_utilisateur = $conn->lastInsertId();

        // ✅ Initialiser la session
        $_SESSION['utilisateur_id'] = $id_nouvel_utilisateur;
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['email'] = $email;

        echo '<div style="...">✅ Utilisateur ajouté avec succès !</div>';

        exit();
    } else {
        echo '<div style="...">❌ Une erreur s\'est produite lors de l\'ajout.</div>';
        session_unset();        // Supprime toutes les variables de session
        session_destroy();      // Détruit la session
    }
}
?>