<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_FILES['excelFile']) && $_FILES['excelFile']['error'] == 0) {
    $fileTmpPath = $_FILES['excelFile']['tmp_name'];
    
    try {
        $spreadsheet = IOFactory::load($fileTmpPath);
    } catch (Exception $e) {
        die('Errore nel caricamento del file: ' . $e->getMessage());
    }
    
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    // richiamo locale
    $hName = 'localhost'; // host
    $uName = 'veytkbae_wp885'; // user
    $password = 'Ciaociam23.'; // psw
    $dbName = 'veytkbae_wp885'; // db

    // conn
    $conn = new mysqli($hName, $uName, $password, $dbName);
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    foreach ($rows as $row) {
        $id = $row[0];
        $voto = $row[5];

        $stmt = $conn->prepare("UPDATE titolari SET voto = ? WHERE id = ?");
        if (!$stmt) {
            die("Preparazione query fallita: " . $conn->error);
        }

        $stmt->bind_param("di", $voto, $id);
        if (!$stmt->execute()) {
            die("Esecuzione query fallita: " . $stmt->error);
        }

        $stmt->close();
    }

        foreach ($rows as $row) {
            $id = $row[0];
            $voto = $row[6];
    
            $stmt = $conn->prepare("UPDATE titolari SET id_giornata = ? WHERE id = ?");
            if (!$stmt) {
                die("Preparazione query fallita: " . $conn->error);
            }
    
            $stmt->bind_param("di", $voto, $id);
            if (!$stmt->execute()) {
                die("Esecuzione query fallita: " . $stmt->error);
            }
    
            $stmt->close();
        }

    $conn->close();
    echo "Dati aggiornati con successo.";
} else {
    echo "Errore nel caricamento del file.";
}
?>
