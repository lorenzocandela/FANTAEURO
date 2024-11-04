<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

include "mydb.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['excelFile'])) {
    $file = $_FILES['excelFile']['tmp_name'];

    // carica exvel
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();

    // numero righe scritte
    $highestRow = $sheet->getHighestDataRow();

    // inserimento
    for ($rowIndex = 2; $rowIndex <= $highestRow; $rowIndex++) {
        // dati singoli
        $rowData = $sheet->rangeToArray('A' . $rowIndex . ':G' . $rowIndex, NULL, TRUE, FALSE)[0];

        $col1 = $dbCon->real_escape_string($rowData[0]);
        $col2 = $dbCon->real_escape_string($rowData[1]);
        $col3 = $dbCon->real_escape_string($rowData[2]);
        $col4 = $dbCon->real_escape_string($rowData[3]);
        $col5 = $dbCon->real_escape_string($rowData[4]);
        $col6 = $dbCon->real_escape_string($rowData[5]);
        $col7 = $dbCon->real_escape_string($rowData[6]);


        // dati nel db
        $sql = "INSERT INTO players (id, name, ruolo, nazionale, owner, capitano, vice) VALUES ('$col1', '$col2', '$col3', '$col4', '$col5', '$col6', '$col7')";
        if ($dbCon->query($sql) === TRUE) {
            echo "ok _";
        } else {
            echo "Errore: " . $sql . "<br>" . $dbCon->error;
        }
    }
} else {
    echo "Nessun file caricato.";
}

$dbCon->close();
?>
