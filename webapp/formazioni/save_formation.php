<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json'); 

$hName = 'localhost';
$uName = 'veytkbae_wp885';
$password = 'Ciaociam23.';
$dbName = 'veytkbae_wp885';

$conn = new mysqli($hName, $uName, $password, $dbName);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Connessione fallita: " . $conn->connect_error]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = file_get_contents('php://input');
    file_put_contents('php://stderr', "Raw input: " . $input . PHP_EOL); // log dell'input raw per debug test

    $data = json_decode($input, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo json_encode(["error" => "Errore nella decodifica del JSON: " . json_last_error_msg()]);
        exit();
    }

    if (!isset($data['owner']) || !isset($data['formation'])) {
        http_response_code(400);
        echo json_encode(["error" => "Dati non ricevuti correttamente"]);
        exit();
    }

    $owner = $data['owner'];
    $formation = $data['formation'];
    
    $id_giornata = null;
    foreach ($formation as $player) {
        if (isset($player['id_giornata'])) {
            $id_giornata = $player['id_giornata'];
            break;
        }
    }
    
    if ($id_giornata === null) {
        http_response_code(400);
        echo json_encode(["error" => "id_giornata non fornito"]);
        exit();
    }

    file_put_contents('php://stderr', "Owner: " . $owner . ", Formation: " . json_encode($formation) . PHP_EOL); // log dati ricevuti test

    $delete_sql = "DELETE FROM titolari WHERE owner = ? AND id_giornata = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    if (!$delete_stmt) {
        http_response_code(500);
        echo json_encode(["error" => "Errore nella preparazione della query di eliminazione: " . $conn->error]);
        exit();
    }
    $delete_stmt->bind_param("si", $owner, $id_giornata);
    if (!$delete_stmt->execute()) {
        http_response_code(500);
        echo json_encode(["error" => "Errore nell'esecuzione della query di eliminazione: " . $delete_stmt->error]);
        exit();
    }

    $insert_sql = "INSERT INTO titolari (owner, role, player_id, player_name, id_giornata) VALUES (?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    if (!$insert_stmt) {
        http_response_code(500);
        echo json_encode(["error" => "Errore nella preparazione della query di inserimento: " . $conn->error]);
        exit();
    }

    foreach ($formation as $player) {
        if (!isset($player['role']) || !isset($player['player_id']) || !isset($player['player_name']) || !isset($player['id_giornata'])) {
            http_response_code(400);
            echo json_encode(["error" => "Dati del giocatore non validi"]);
            exit();
        }

        $insert_stmt->bind_param("ssisi", $owner, $player['role'], $player['player_id'], $player['player_name'], $player['id_giornata']);
        if (!$insert_stmt->execute()) {
            http_response_code(500);
            echo json_encode(["error" => "Errore nell'esecuzione della query di inserimento: " . $insert_stmt->error]);
            exit();
        }
    }

    $delete_stmt->close();
    $insert_stmt->close();

    echo json_encode(["success" => "Formazione salvata con successo"]);
} else {
    http_response_code(405);
    echo json_encode(["error" => "Metodo non consentito"]);
}

$conn->close();
?>
