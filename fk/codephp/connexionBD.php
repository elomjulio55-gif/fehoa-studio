    <?php
    // Connexion à la base de données PostgreSQL
    $host = 'localhost';
    $port = '3306';
    $dbname = 'FEHAO';
    $user = 'user';
    $password = '';

    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
    if (!$conn) {
        die("Échec de la connexion à PostgreSQL : " . pg_last_error());
    }
    session_start();
    ?>
