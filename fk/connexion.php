<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Connexion - Al-Ummah Shopping</title>
<link rel="stylesheet" href="codecss\connexion.css">

</head>

<body class="">

  <h1>Connexion</h1>

  <section>
    <form action="codephp\compte\codeconnexion.php" method="POST" class="form-container">

      <label for="email">Email</label>
      <input
        type="email"
        id="email"
        name="email"
        required
      />

      <label for="motdepasse">Mot de passe</label>
      <input
        type="password"
        id="motdepasse"
        name="motdepasse"
        required
      />

      <div class="btn-row">
        <input type="submit" value="Se connecter" />
        <input type="reset" value="Réinitialiser" />
      </div>

      <div class="links">
        <a href="creercompte.php">Créer un compte</a>
        <a href="http://localhost/projetboutiqueV2/livraison/connexion.php">Livreur</a>
      </div>

    </form>
  </section>

</body>
</html>
