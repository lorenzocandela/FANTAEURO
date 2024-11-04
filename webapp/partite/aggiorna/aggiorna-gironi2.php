<?php


$users = [
    'lollo' => 2,
    'coda' => 0,
    'aqui' => 1,
    'formi' => 3,
    'mirko' => 4,
    'fra' => 5,
    'tota' => 6,
    'pol' => 7
];

$giornata = 2; // Puoi cambiare il valore della giornata come necessario
$results = [];

foreach ($users as $owner => $id) {
    // Query per aggiornare score_1 dove id_utente_1 è $id
    $query1 = "
        UPDATE matchup
        SET score_1 = (
            SELECT SUM(voto)
            FROM titolari
            WHERE owner = '$owner' AND id_giornata = $giornata
        )
        WHERE id_utente_1 = $id AND giornata = $giornata;
    ";

    // Query per aggiornare score_2 dove id_utente_2 è $id
    $query2 = "
        UPDATE matchup
        SET score_2 = (
            SELECT SUM(voto)
            FROM titolari
            WHERE owner = '$owner' AND id_giornata = $giornata
        )
        WHERE id_utente_2 = $id AND giornata = $giornata;
    ";

    // Esecuzione della prima query
    if ($conn->query($query1) === TRUE) {
        $results[] = "La colonna score_1 è stata aggiornata con successo dove id_utente_1 è $id.";
        echo "<script>console.log('La colonna score_1 è stata aggiornata con successo dove id_utente_1 è $id.');</script>";
    } else {
        $results[] = "Errore nell'aggiornamento della colonna score_1 per id_utente_1 = $id: " . $dbCon->error;
        echo "<script>console.log('Errore nell'aggiornamento della colonna score_1 per id_utente_1 = $id: " . $dbCon->error . "');</script>";
    }

    // Esecuzione della seconda query
    if ($conn->query($query2) === TRUE) {
        $results[] = "La colonna score_2 è stata aggiornata con successo dove id_utente_2 è $id.";
        echo "<script>console.log('La colonna score_2 è stata aggiornata con successo dove id_utente_2 è $id.');</script>";
    } else {
        $results[] = "Errore nell'aggiornamento della colonna score_2 per id_utente_2 = $id: " . $dbCon->error;
        echo "<script>console.log('Errore nell'aggiornamento della colonna score_2 per id_utente_2 = $id: " . $dbCon->error . "');</script>";
    }
}

?>
