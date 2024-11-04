<?php
// local da fixare
$hName = 'localhost'; // host
$uName = 'veytkbae_wp885'; // user
$password = 'Ciaociam23.'; // psw
$dbName = 'veytkbae_wp885'; // db

// conn
$dbCon = new mysqli($hName, $uName, $password, $dbName);

// check
if ($dbCon->connect_error) {
    die("Connessione al database fallita: " . $dbCon->connect_error);
}

if (isset($_POST['nazione'])) {
    $nazione = $_POST['nazione'];

    $query = "SELECT name, ruolo, nazionale FROM players WHERE nazionale = '$nazione'";
    $result = mysqli_query($dbCon, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="single-player">
                <img src="./img/placeholder.png" class="p-img">
                <div class="player-info">
                    <span class="name-player">' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '</span><br>
                    <span class="role-player">' . htmlspecialchars($row['ruolo'], ENT_QUOTES, 'UTF-8') . '</span><span class="role-player-naz">' . htmlspecialchars($row['nazionale'], ENT_QUOTES, 'UTF-8') . '</span>
                </div>
            </div>';
        }
    } else {
        echo "<span class='roaster-title'>Nessun giocatore trovato per questa nazione.</span>";
    }
} else {
    echo "error"; // errore se la nazione non è stata ricevuta correttamente
}
?>
