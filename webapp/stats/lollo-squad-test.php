<div class="box-high" style="margin: 0; margin-top: -90px; background: none; box-shadow: none;">
        <div class="classifica">
        <?php
// Inclusione del file di configurazione del database
$hName = 'localhost'; // Nome host
$uName = 'veytkbae_wp885'; // Nome utente del database
$password = 'Ciaociam23.'; // Password del database
$dbName = 'veytkbae_wp885'; // Nome del database

// Connessione al database
$dbCon = new mysqli($hName, $uName, $password, $dbName);

// Verifica la connessione
if ($dbCon->connect_error) {
    die("Connessione al database fallita: " . $dbCon->connect_error);
}

// Controllo della connessione al database
if (!$dbCon) {
    die("Connessione al database fallita: " . mysqli_connect_error());
}

// Esecuzione della query per selezionare tutti i nomi dei giocatori
$query = "SELECT name, ruolo, nazionale FROM players WHERE owner = 'LOLLO'";
$result = mysqli_query($dbCon, $query);

// Controllo se la query ha restituito dei risultati
if (mysqli_num_rows($result) > 0) {
    // Itera attraverso i risultati della query
    while ($row = mysqli_fetch_assoc($result)) {
        echo '                <div class="single-player">
        <img src="./img/placeholder-player.png" class="p-img">
        <div class="player-info">
            <span class="name-player">' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '</span><br>
            <span class="role-player">' . htmlspecialchars($row['ruolo'], ENT_QUOTES, 'UTF-8') . '</span><span class="role-player">' . htmlspecialchars($row['nazionale'], ENT_QUOTES, 'UTF-8') . '</span></div></div>';
    }
} else {
    echo "<span class='roaster-title'>ROASTER:</span>";
}

// Chiusura della connessione al database
mysqli_close($dbCon);
?>


                
            </div>
        </div>
</div>