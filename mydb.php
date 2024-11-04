<?php

// conn
$dbCon = new mysqli($hName, $uName, $password, $dbName);

// check
if ($dbCon->connect_error) {
    die("Connessione al database fallita: " . $dbCon->connect_error);
}
?>
