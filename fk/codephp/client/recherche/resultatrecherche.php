<?php

session_start();

require('../../connexionBD.php');

// Récupère les données du formulaire
$specialite = $_SESSION['specialite'] ?? '';
$note_moyenne = $_POST['note_moyenne'] ?? '';
$date_souhaitee = $_POST['date_souhaitee'] ?? '';
$latitude = $_POST['latitude'] ?? '';
$longitude = $_POST['longitude'] ?? '';


// Insertion
$stmt = $conn->prepare("SELECT prestataire.ID, realisation.date_debut, realisation.date_fin FROM prestataire, realisation, demande WHERE realisation.demande_id = demande.ID AND demande.prestataire_id = prestataire.ID AND prestataire.specialite = ? AND prestataire.note_moyenne >= ? AND prestataire.disponibilite = 'disponible' AND prestataire.latitude BETWEEN ?-0.045 AND ?+0.045 AND prestataire.longitude BETWEEN ?-0.045 AND ?+0.045 AND !(? BETWEEN realisation.date_debut AND realisation.date_fin) GROUP BY prestataire.ID");
$stmt->bind_param("sddddds", $specialite, $note_moyenne, $latitude, $latitude, $longitude, $longitude, $date_souhaitee);
$success = $stmt->execute();

if (!$success) {
    echo '<div style="...">❌ Une erreur s\'est produite.</div>';
} else {
    $res = $stmt->get_result();
    echo '<table border="1">
            <thead>
                <tr>
                    <th>ID Prestataire</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                </tr>
            </thead>
            <tbody>';
    while ($row = $res->fetch_assoc()) {
        echo '<tr>
                <td>' . htmlspecialchars($row['ID']) . '</td>
                <td>' . htmlspecialchars($row['date_debut']) . '</td>
                <td>' . htmlspecialchars($row['date_fin']) . '</td>
              </tr>';
    }
    echo '</tbody></table>';
}
?>