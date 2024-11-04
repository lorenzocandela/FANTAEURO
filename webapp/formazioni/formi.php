<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gironi</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../font/css/cabinet-grotesk.css">
</head>
<body>
<div id="container">
    
    <select id="formationSelect" onchange="updateFormation()">
        <option value="3-5-2">3-5-2</option>
        <option value="3-4-3">3-4-3</option>
        <option value="4-4-2">4-4-2</option>
        <option value="4-3-3">4-3-3</option>
        <option value="4-5-1">4-5-1</option>
        <option value="5-4-1">5-4-1</option>
        <option value="5-3-2">5-3-2</option>
    </select>
    <div id="formation"></div>
    <div id="playersList"></div>
    <button onclick="saveFormation()">Salva Formazione</button><br>
    <a id="dynamicLink" href="#">INDIETRO</a>
    <div id="titolariList"></div>
</div>
<input type="hidden" id="owner" value="">
<input type="hidden" id="id_giornata" value="">
<script src="./js/caricabene.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const baseUrl = "https://fantaeuropei.netsons.org/webapp/";
        const currentUrl = window.location.href;
        const partBeforePhp = currentUrl.substring(0, currentUrl.lastIndexOf(".php"));
        const newHref = baseUrl + partBeforePhp.substring(partBeforePhp.lastIndexOf("/") + 1) + ".php";
        document.getElementById("dynamicLink").setAttribute("href", newHref);

        const urlParams = new URLSearchParams(window.location.search);
        const idGiornata = urlParams.get('id_giornata');

        document.getElementById('id_giornata').value = idGiornata;
    });
</script>
</body>
</html>

