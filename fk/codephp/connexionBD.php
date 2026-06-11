    <?php
    // Connexion à la base de données PostgreSQL
    $host = 'localhost';
    $dbname = 'artilink';
    $user = 'user';
    $password = '';

    $conn = mysqli_connect($host,$user,$password,$dbname);
    if (!$conn) {
        die("Échec de la connexion à PostgreSQL : " . mysqli_connect_error);
    }
    
    ?>
