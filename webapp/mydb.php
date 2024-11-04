<?php
$servername = "localhost";
$username = "veytkbae_wp885";
$password = "Ciaociam23.";
$dbname = "veytkbae_wp885";

// Creare connessione
$con = mysqli_connect($servername, $username, $password, $dbname);

// Controlla la connessione
if (!$con) {
    die("Connessione fallita: " . mysqli_connect_error());
}
?>