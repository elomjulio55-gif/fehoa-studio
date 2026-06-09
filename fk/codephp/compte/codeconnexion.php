<?php
session_start(); // ⚡ Démarre la session

try {
    $conn = new PDO("pgsql:host=localhost;dbname=sitedevente", "postgres", "raymond2008");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$email = $_POST['email'] ?? '';
$motdepasse = $_POST['motdepasse'] ?? '';

$stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE email = :email");
$stmt->execute(['email' => $email]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    if (password_verify($motdepasse, $row['motdepasse'])) {
        $_SESSION['utilisateur_id'] = $row['idutilisateur'];
        $_SESSION['pseudo'] = $row['pseudo'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = $row['role'];

        echo '<div style="padding: 15px; margin: 20px auto; border: 2px solid green; color: green; background-color: #eaf8ea; width: 60%; text-align: center; border-radius: 8px;">
                ✅ Connexion réussie. Bienvenue ' . htmlspecialchars($row['pseudo']) . ' !<br>
                Vous allez être redirigé...
              </div>';
        exit();
    } else {
        echo '<div style="padding: 15px; margin: 20px auto; border: 2px solid orange; color: orange; background-color: #fff6e0; width: 60%; text-align: center; border-radius: 8px;">
                ⚠️ Aucun utilisateur trouvé.
              </div>';
            session_unset();        // Supprime toutes les variables de session
            session_destroy();      // Détruit la session
    }
} else {
    echo '<div style="padding: 15px; margin: 20px auto; border: 2px solid orange; color: orange; background-color: #fff6e0; width: 60%; text-align: center; border-radius: 8px;">
            ⚠️ Aucun utilisateur trouvé.
          </div>';
          
        
            session_unset();        // Supprime toutes les variables de session
            session_destroy();      // Détruit la session
}
?>