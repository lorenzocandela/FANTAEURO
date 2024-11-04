<?php
// locale che va in errore fai check poi
$hName = 'localhost'; // host
$uName = 'veytkbae_wp885'; // user
$password = 'Ciaociam23.'; // psw
$dbName = 'veytkbae_wp885'; // db

// conn
$dbCon = new mysqli($hName, $uName, $password, $dbName);

// check
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// mappa tra ID utente e percorsi delle immagini
$immagini = array(
    0 => "./img/squadre/coda.png",
    1 => "./img/squadre/aqui.png",
    2 => "./img/squadre/lollo.png",
    3 => "./img/squadre/formi.png",
    4 => "./img/squadre/mirko.png",
    5 => "./img/squadre/fra.png",
    6 => "./img/squadre/tota.png",
    7 => "./img/squadre/pol.png"
);

// prende nome utente dalla URL della pagina
$pagina_corrente = basename($_SERVER['PHP_SELF']);
$nome_utente = str_replace('.php', '', $pagina_corrente);

// ottiene ID utente corrispondente al nome utente
$id_utente = -1; // def
switch ($nome_utente) {
    case "coda":
        $id_utente = 0;
        break;
    case "aqui":
        $id_utente = 1;
        break;
    case "lollo":
        $id_utente = 2;
        break;
    case "formi":
        $id_utente = 3;
        break;
    case "mirko":
        $id_utente = 4;
        break;
    case "fra":
        $id_utente = 5;
        break;
    case "tota":
        $id_utente = 6;
        break;
    case "pol":
        $id_utente = 7;
        break;
    default:
        // utente non valido
        die("Nome utente non valido: $nome_utente");
}

// query per ottenere i matchup dell'utente specifico
$sql = "SELECT giornata, id_utente_1, id_utente_2, score_1, score_2 
        FROM matchup 
        WHERE id_utente_1 = $id_utente OR id_utente_2 = $id_utente";
$result = $conn->query($sql);

?>

<?php
// cehck se ci sono matchup
if ($result->num_rows > 0) {
    echo "<ul>";
    // stmpa dei matchup
    while($row = $result->fetch_assoc()) {
        echo "<li>";
        echo "<img class='img-scontri' src='" . $immagini[$row["id_utente_1"]] . "' alt=''>";
        echo "<span class='result'>" . $row["score_1"] . " - " . $row["score_2"] . "</span>";
        echo "<img class='img-scontri' src='" . $immagini[$row["id_utente_2"]] . "' alt=''></li>";
    }
    echo "</ul>";
} else {
    echo "Nessun matchup trovato per l'utente '$nome_utente'";
}

$conn->close();
?>