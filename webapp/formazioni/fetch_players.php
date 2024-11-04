<?php

$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', $url);
$owner = $parts[count($parts) - 1]; // prende l'ultimo segmento dell'URL come nome dell'owner
$owner = str_replace('-test.php', '', $owner); // toglie "-squad.php" se ce


// test richiamo locale che esterno fallisce (ricorda)
$hName = 'localhost'; // host
$uName = 'veytkbae_wp885'; // user
$password = 'Ciaociam23.'; // psw
$dbName = 'veytkbae_wp885'; // db

// conn
$conn = new mysqli($hName, $uName, $password, $dbName);

// check
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['role']) || !isset($_POST['owner'])) {
        die("Ruolo o proprietario non ricevuti");
    }

    $role = $_POST['role'];
    $owner = $_POST['owner'];
    $sql = "SELECT * FROM players WHERE ruolo = ? AND owner = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Errore nella preparazione della query: " . $conn->error);
    }

    $stmt->bind_param("ss", $role, $owner);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result === false) {
        die("Errore nell'esecuzione della query: " . $stmt->error);
    }

    $players = array();
    while ($row = $result->fetch_assoc()) {
        $players[] = $row;
    }

    echo json_encode($players);

    $stmt->close();
}

$conn->close();
?>

