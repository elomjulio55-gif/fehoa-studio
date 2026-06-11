<?php
session_start(); // ⚡ Démarre la session

require('../connexionBD.php');

$email = $_POST['email'] ?? '';
$mot_de_passe = $_POST['mot_de_passe'] ?? '';

$req = $conn->prepare("SELECT * FROM utilisateur WHERE email = ?");
$req->bind_param("s", $email);
$req->execute();
$res = $req->get_result();
$row = $res->fetch_assoc();

if ($row) {
    if (password_verify($mot_de_passe, $row['mot_de_passe'])) {
        $_SESSION['utilisateur_id'] = $row['idutilisateur'];
        $_SESSION['nom'] = $row['nom'];
        $_SESSION['prenom'] = $row['prenom'];
        $_SESSION['telephone'] = $row['telephone'];
        $_SESSION['email'] = $row['email'];

        echo '<div style="padding: 15px; margin: 20px auto; border: 2px solid green; color: green; background-color: #eaf8ea; width: 60%; text-align: center; border-radius: 8px;">
                ✅ Connexion réussie. Bienvenue ' . htmlspecialchars($row['nom']) . ' !<br>
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