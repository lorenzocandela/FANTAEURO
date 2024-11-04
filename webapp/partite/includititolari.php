<?php
$hName = 'localhost';
$uName = 'veytkbae_wp885';
$password = 'Ciaociam23.';
$dbName = 'veytkbae_wp885';

$conn = new mysqli($hName, $uName, $password, $dbName);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

function getPlayers($conn, $owner, $giornata) {
    $query = "SELECT player_name, role, voto FROM titolari WHERE owner = ? AND id_giornata = ? ORDER BY id DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $owner, $giornata);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<div style='display: flex; justify-content: center;'><ul style='margin-left: -27px; align-items: flex-start; '>";
        while ($row = $result->fetch_assoc()) {
            $playerName = $row['player_name'];

            // check se il giocatore è il capitano
            $capQuery = "SELECT capitano FROM players WHERE name = ? AND capitano = 'SI'";
            $capStmt = $conn->prepare($capQuery);
            $capStmt->bind_param("s", $playerName);
            $capStmt->execute();
            $capResult = $capStmt->get_result();
            $capitanoSpan = ($capResult->num_rows > 0) ? '<span class="player-cap">CAP</span>' : '';
            $capStmt->close();

            // check se il giocatore è il vice-capitano
            $vicecapQuery = "SELECT vice FROM players WHERE name = ? AND vice = 'SI'";
            $vicecapStmt = $conn->prepare($vicecapQuery);
            $vicecapStmt->bind_param("s", $playerName);
            $vicecapStmt->execute();
            $vicecapResult = $vicecapStmt->get_result();
            $vicecapitanoSpan = ($vicecapResult->num_rows > 0) ? '<span class="vice-player-cap">VICE</span>' : '';
            $vicecapStmt->close();

            echo '<div class="single-player">
                <div class="player-info">
                    <span class="name-player">' . htmlspecialchars($playerName, ENT_QUOTES, 'UTF-8') . '</span><br>
                    <span class="role-player">' . htmlspecialchars($row['role'], ENT_QUOTES, 'UTF-8') . '</span>
                    ' . $capitanoSpan . $vicecapitanoSpan . '<br>
                </div><span class="vote-player">' . htmlspecialchars($row['voto'], ENT_QUOTES, 'UTF-8') . '
            </div>';
        }
        echo "</ul></div>";
    } else {
        echo "<p>Nessun giocatore titolare trovato per " . htmlspecialchars($owner, ENT_QUOTES, 'UTF-8') . "</p>";
    }

    $stmt->close();
}

if ($nome_utente == "lollo") {
    $opp1 = 2;
} elseif ($nome_utente == "aqui") {
    $opp1 = 1;
} elseif ($nome_utente == "formi") {
    $opp1 = 3;
} elseif ($nome_utente == "coda") {
    $opp1 = 0;
} elseif ($nome_utente == "mirko") {
    $opp1 = 4;
} elseif ($nome_utente == "fra") {
    $opp1 = 5;
} elseif ($nome_utente == "tota") {
    $opp1 = 6;
} elseif ($nome_utente == "pol") {
    $opp1 = 7;
} else {
    $opp1 = null;
}

$sql_matchup_id = "SELECT id FROM matchup WHERE (id_utente_1 = ? OR id_utente_2 = ?) AND giornata = ?";
$stmt_matchup_id = $conn->prepare($sql_matchup_id);
$stmt_matchup_id->bind_param("ssi", $opp1, $opp1, $giornata);
$stmt_matchup_id->execute();
$result_matchup_id = $stmt_matchup_id->get_result();

if ($result_matchup_id->num_rows > 0) {
    $row_matchup_id = $result_matchup_id->fetch_assoc();
    $matchup_id = $row_matchup_id['id'];

    echo "<script>console.log('ID della partita in cui $nome_utente è coinvolto nella giornata 1:', $matchup_id);</script>";

    $sql_opposite_user_id = "SELECT id_utente_1, id_utente_2 FROM matchup WHERE id = ? AND (id_utente_1 != ? OR id_utente_2 != ?)";
    $stmt_opposite_user_id = $conn->prepare($sql_opposite_user_id);
    $stmt_opposite_user_id->bind_param("sss", $matchup_id, $opp1, $opp1);

    $stmt_opposite_user_id->execute();
    $result_opposite_user_id = $stmt_opposite_user_id->get_result();

    if ($result_opposite_user_id->num_rows > 0) {
        $row_opposite_user_id = $result_opposite_user_id->fetch_assoc();
        $opposite_user_id = $row_opposite_user_id['id_utente_1'] !== $opp1 ? $row_opposite_user_id['id_utente_1'] : $row_opposite_user_id['id_utente_2'];

        echo "<script>console.log('ID dell\'utente opposto:', $opposite_user_id);</script>";

        $sql_opposite_team_name = "SELECT correlato FROM matchup WHERE id_chiave = ?";
        $stmt_opposite_team_name = $conn->prepare($sql_opposite_team_name);
        $stmt_opposite_team_name->bind_param("i", $opposite_user_id);
        $stmt_opposite_team_name->execute();
        $result_opposite_team_name = $stmt_opposite_team_name->get_result();

        if ($result_opposite_team_name->num_rows > 0) {
            $row_opposite_team_name = $result_opposite_team_name->fetch_assoc();
            $nome_utente_opposto = $row_opposite_team_name['correlato'];

            echo "<script>console.log('Nome della squadra opposta:', '$nome_utente_opposto');</script>";

            if ($nome_utente == "lollo") {
                $show1 = "Intesa Sau Paulo";
            } elseif ($nome_utente == "aqui") {
                $show1 = "Gyatito Loco";
            } elseif ($nome_utente == "formi") {
                $show1 = "FORMIGANG";
            } elseif ($nome_utente == "coda") {
                $show1 = "Karim Nueve CF";
            } elseif ($nome_utente == "mirko") {
                $show1 = "Arbeit";
            } elseif ($nome_utente == "fra") {
                $show1 = "Usa e Getta";
            } elseif ($nome_utente == "tota") {
                $show1 = "MafiaBoys";
            } elseif ($nome_utente == "pol") {
                $show1 = "FAT RAT";
            } else {
                $show1 = null;
            }
            echo "<h2>" . htmlspecialchars($show1, ENT_QUOTES, 'UTF-8') . "</h2>";
            getPlayers($conn, $nome_utente, $giornata);

            if ($nome_utente_opposto == "lollo") {
                $show1 = "Intesa Sau Paulo";
            } elseif ($nome_utente_opposto == "aqui") {
                $show1 = "Gyatito Loco";
            } elseif ($nome_utente_opposto == "formi") {
                $show1 = "FORMIGANG";
            } elseif ($nome_utente_opposto == "coda") {
                $show1 = "Karim Nueve CF";
            } elseif ($nome_utente_opposto == "mirko") {
                $show1 = "Arbeit";
            } elseif ($nome_utente_opposto == "fra") {
                $show1 = "Usa e Getta";
            } elseif ($nome_utente_opposto == "tota") {
                $show1 = "MafiaBoys";
            } elseif ($nome_utente_opposto == "pol") {
                $show1 = "FAT RAT";
            } else {
                $nome_utente_opposto = null;
            }
            echo "<h2>" . htmlspecialchars($show1, ENT_QUOTES, 'UTF-8') . "</h2>";
            getPlayers($conn, $nome_utente_opposto, $giornata);
        } else {
            echo "<script>console.log('Nessun nome squadra opposta trovato.');</script>";
        }
    } else {
        echo "<script>console.log('Nessun utente opposto trovato per la partita.');</script>";
    }
} else {
    echo "<script>console.log('Nessuna partita trovata per $nome_utente nella giornata $giornata.');</script>";
}

$stmt_matchup_id->close();
$stmt_opposite_user_id->close();
$stmt_opposite_team_name->close();

$conn->close();
?>
