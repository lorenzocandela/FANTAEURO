<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <title>FantaEuropei</title>
        <meta name="viewport" content="width=device-width; initial-scale=1.0; user-scalable=no" />
        <link rel="stylesheet" href="../../css/style.css?v=3.1">
        <link rel="stylesheet" href="../font/css/cabinet-grotesk.css">

        <style>
        body {
            text-align: center;
        }
        .img-scontri {
            width: 100px;
            box-shadow: 0 5px 7px 0 rgb(0 0 0 / 24%), 0 12px 29px 0 rgb(0 0 0 / 12%);
            border-radius: 80px;
            border: solid #ffffff 3px;
        }
        ul {
            display: flex;
            list-style: none;
            font-family: 'CabinetGrotesk-Bold';
            margin: 0;
            padding: 0;
            text-align: left;
            margin-bottom: 40px;
            margin-top: 25px;
            flex-direction: column;
            margin-left: 0px;
        }
        li {
            display: flex;
            align-items: center;
        }
        .title-gior {
            font-size: 33px;
            display: block;
            margin-left: -29px;
        }
        .result {
    font-size: 40px;
    padding: 20px;
    font-family: 'CabinetGrotesk-Black';
}
        .name-player {
            font-family: 'CabinetGrotesk-ExtraBold';
            font-size: 15px;
            text-transform: capitalize;
            color: #000;
            padding: 10px;
        }
        .single-player {
            align-items: center;
            padding: 10px;
            background: #0000000a;
            width: auto;
            border-radius: 100px;
            margin: 5px 0;
            display: inline-flex;
            height: 12px;
        }
        .vote-player {
            padding-left: 40px;
            /* position: absolute; */
            font-family: 'CabinetGrotesk-Black';
            font-size: 23px;
            opacity: 0.8;
        }
        .player-info {
            display: contents;
        }
        h2 {
            font-family: 'CabinetGrotesk-Black';
            margin-bottom: 0px;
            margin-top: 40px;
        }
        </style>
    </head>

    <?php
    $hName = 'localhost';
    $uName = 'veytkbae_wp885';
    $password = 'Ciaociam23.';
    $dbName = 'veytkbae_wp885';

    $conn = new mysqli($hName, $uName, $password, $dbName);

    if ($conn->connect_error) {
        die("Connessione al database fallita: " . $conn->connect_error);
    }

    $immagini = array(
        0 => "../img/squadre/coda.png",
        1 => "../img/squadre/aqui.png",
        2 => "../img/squadre/lollo.png",
        3 => "../img/squadre/formi.png",
        4 => "../img/squadre/mirko.png",
        5 => "../img/squadre/fra.png",
        6 => "../img/squadre/tota.png",
        7 => "../img/squadre/pol.png"
    );

    include './aggiorna/aggiorna-gironi2.php';

    if (isset($_GET['nome_utente'])) {
        $nome_utente = $_GET['nome_utente'];
    } else {
        die("Nome utente non fornito.");
    }

    $giornata = 2;
    $id_utente = -1;
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
            die("Nome utente non valido: $nome_utente");
    }

    $sql = "SELECT giornata, id_utente_1, id_utente_2, score_1, score_2 
            FROM matchup 
            WHERE (id_utente_1 = $id_utente OR id_utente_2 = $id_utente) AND giornata = 2";
    $result = $conn->query($sql);



    if ($result->num_rows > 0) {
        echo "<ul style='align-items: center;'>";

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

    <a href="../formazioni/<?php echo $nome_utente; ?>.php?id_giornata=<?php echo $giornata; ?>"><img class="banner-giornate" src="../img/add.png"></a>
    <?php $giornata = 2; include 'includititolari.php';?>


</body>

    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  
<script>
//versione 1.2
</script>
</html>