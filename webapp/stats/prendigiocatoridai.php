<?php
$hName = 'localhost';
$uName = 'veytkbae_wp885';
$password = 'Ciaociam23.';
$dbName = 'veytkbae_wp885';

$dbCon = new mysqli($hName, $uName, $password, $dbName);

if ($dbCon->connect_error) {
    die("Connessione al database fallita: " . $dbCon->connect_error);
}

$path = $_SERVER['REQUEST_URI'];
$filename = basename($path);
$owner = preg_replace('/\.php$/', '', $filename);

$query = "SELECT name, ruolo, nazionale, capitano, vice FROM players WHERE owner = ?";
$stmt = $dbCon->prepare($query);
if ($stmt) {
    $stmt->bind_param("s", $owner);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $capitanoSpan = '';
            $vicecapitanoSpan = '';
            $additionalClass = '';

            if ($row['capitano'] == 'SI') {
                $capitanoSpan = '<span class="player-cap">CAP</span>';
            } else if ($row['vice'] == 'SI') {
                $vicecapitanoSpan = '<span class="vice-player-cap">VICE</span>';
            }

            switch ($row['ruolo']) {
                case 'ATT':
                    $additionalClass = 'div-att';
                    break;
                case 'CEN':
                    $additionalClass = 'div-cen';
                    break;
                case 'DIF':
                    $additionalClass = 'div-dif';
                    break;
                case 'POR':
                    $additionalClass = 'div-por';
                    break;
                default:
                    $additionalClass = '';
                    break;
            }

            echo '<div class="single-player ' . $additionalClass . '">
                <div class="player-info">
                    <span class="name-player">' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '</span><br>
                    <span class="role-player">' . htmlspecialchars($row['ruolo'], ENT_QUOTES, 'UTF-8') . '</span>
                    <span class="role-player">' . htmlspecialchars($row['nazionale'], ENT_QUOTES, 'UTF-8') . '</span>
                    ' . $capitanoSpan . $vicecapitanoSpan . '
                </div>
            </div>';
            echo "<script>console.log('Capitano: {$row['capitano']}, Vice: {$row['vice']}, Ruolo: {$row['ruolo']}');</script>";
        }
    } else {
        echo "<span class='roaster-title'>vuoto</span>";
    }

    $stmt->close();
} else {
    echo "Errore nella preparazione della query: " . $dbCon->error;
}

$dbCon->close();
?>