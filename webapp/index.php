<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="manifest" href="manifest.json?v=<?= time() ?>">
    <link rel="apple-touch-icon" href="./img/logo.png">
    <link rel="stylesheet" href="./font/css/cabinet-grotesk.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FantaEuropei</title>
    <link rel="stylesheet" href="../css/style.css?v=<?= time() ?>">
    <style>
        .collegamento {
            font-family: 'CabinetGrotesk-Bold';
            color: #000;
            font-size: 25px;
            margin: 70px;
            display: block;
        }
    </style>
</head>
<body style="text-align: center">
    <img style="    width: 50%; display: flex;" src="./img/logo_neg.png">
    <a href="https://fantaeuropei.netsons.org/webapp/coda.php"><img src="./img/squadre/coda.png" class="nazione-img-ind"></a>
    <a href="https://fantaeuropei.netsons.org/webapp/fra.php"><img src="./img/squadre/fra.png" class="nazione-img-ind"></a>
    <a href="https://fantaeuropei.netsons.org/webapp/aqui.php"><img src="./img/squadre/aqui.png" class="nazione-img-ind"></a>
    <a href="https://fantaeuropei.netsons.org/webapp/formi.php"><img src="./img/squadre/formi.png" class="nazione-img-ind"></a>
    <a href="https://fantaeuropei.netsons.org/webapp/lollo.php"><img src="./img/squadre/lollo.png" class="nazione-img-ind"></a>
    <a href="https://fantaeuropei.netsons.org/webapp/mirko.php"><img src="./img/squadre/mirko.png" class="nazione-img-ind"></a>
    <a href="https://fantaeuropei.netsons.org/webapp/tota.php"><img src="./img/squadre/tota.png" class="nazione-img-ind"></a>
    <a href="https://fantaeuropei.netsons.org/webapp/pol.php"><img src="./img/squadre/pol.png" class="nazione-img-ind"></a>

    <br><br>

    <a class="collegamento" href="https://fantaeuropei.netsons.org/webapp/stats/classifica.php">CLASSIFICA</a>

    <script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/service-worker.js').then(function(registration) {
            console.log('Service Worker registered with scope:', registration.scope);
            // invia un messaggio al service worker per pulire la cache (NON VA)
            if (navigator.serviceWorker.controller) {
                navigator.serviceWorker.controller.postMessage({ action: 'cleanCache' });
            }
        }).catch(function(error) {
            console.log('Service Worker registration failed:', error);
        });
    }
    </script>
</body>
</html>
