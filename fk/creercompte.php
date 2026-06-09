<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Créer un compte - Sixteen Clothing</title>
  
</head>
<body>

  <h1>Créer un compte</h1>

  <section>
    <form action="ajouter.php" method="POST" class="form-container">
      <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input type="text" class="form-control" id="pseudo" name="pseudo" required />
      </div>
      
      <div class="form-group">
        <label for="email">Email</label>
        <input
          type="email"
          class="form-control"
          id="email"
          name="email"
          required
        />
      </div>
      
      <div class="form-group">
        <label for="motdepasse">Mot de passe</label>
        <input
          type="password"
          class="form-control"
          id="motdepasse"
          name="motdepasse"
          required
        />
      </div>
      
      <div class="d-flex justify-content-between">
        <input type="submit" value="Envoyer" class="btn btn-primary" />
        <input type="reset" value="Réinitialiser" class="btn btn-secondary" />
      </div>

      <div class="links">
          <a href="http://localhost/projetboutique1/connexioncompte/connexion.php">client</a>
          <a href="http://localhost/projetboutique1/connexioncompte/connexion.php">client</a>
      </div>
    </form>
  </section>

</body>
</html>
