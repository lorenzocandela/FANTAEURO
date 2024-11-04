<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>FantaEuropei</title>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; user-scalable=no" />
    <link rel="stylesheet" href="./../css/style.css?v=3.1">
    <link rel="stylesheet" href="./font/css/cabinet-grotesk.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>
        function myFunction(element) {
            console.log("ok");
            var nazione = $(element).data("nazione");

            $.ajax({
                type: "POST",
                url: "get_giocatori_nazione.php",
                data: { nazione: nazione },
                success: function(response) {
                    $(".classifica").html(response);
                },
                error: function(xhr, status, error) {
                    alert("Si è verificato un errore durante il recupero dei giocatori della nazione.");
                }
            });
        }
    </script>
    <style>
        .nazione-img {
            width: 45px;
            margin: 5px;
            border: solid 3px #1433d126;
            border-radius: 60%;
        }
        .nazioni-container {
            margin-top: -90px;
            margin-bottom: 100px;
            padding: 20px 30px;
        }
    </style>
</head>
<body style="text-align: center;">

    <img src="./img/banner-home.png" class="banner">
    <!--<img src="./img/lega.png" class="banner-logo">-->
    <img src="./img/shape.png" style="width: 100%; margin-top: 75px; ">

    <br>

    <div class="nazioni-container">
        <img onclick="myFunction(this)" src="./img/flags/albania.png" class="nazione-img" data-nazione="albania">
        <img onclick="myFunction(this)" src="./img/flags/austria.png" class="nazione-img" data-nazione="austria">
        <img onclick="myFunction(this)" src="./img/flags/belgio.png" class="nazione-img" data-nazione="belgio">
        <img onclick="myFunction(this)" src="./img/flags/croazia.png" class="nazione-img" data-nazione="croazia">
        <!-- hr??? -->
        <img onclick="myFunction(this)" src="./img/flags/repcec.png" class="nazione-img" data-nazione="Repubblica Ceca">
        <img onclick="myFunction(this)" src="./img/flags/danimarca.png" class="nazione-img" data-nazione="danimarca">
        <img onclick="myFunction(this)" src="./img/flags/inghilterra.png" class="nazione-img" data-nazione="inghilterra">
        <img onclick="myFunction(this)" src="./img/flags/italia.png" class="nazione-img" data-nazione="francia">
        <!-- hr??? -->
        <img onclick="myFunction(this)" src="./img/flags/georgia.png" class="nazione-img" data-nazione="georgia">
        <img onclick="myFunction(this)" src="./img/flags/germania.png" class="nazione-img" data-nazione="germania">
        <img onclick="myFunction(this)" src="./img/flags/ungheria.png" class="nazione-img" data-nazione="ungheria">
        <img onclick="myFunction(this)" src="./img/flags/italia.png" class="nazione-img" data-nazione="italia">
        <!-- hr??? -->
        <img onclick="myFunction(this)" src="./img/flags/olanda.png" class="nazione-img" data-nazione="olanda">
        <img onclick="myFunction(this)" src="./img/flags/polonia.png" class="nazione-img" data-nazione="polonia">
        <img onclick="myFunction(this)" src="./img/flags/portogallo.png" class="nazione-img" data-nazione="portogallo">
        <img onclick="myFunction(this)" src="./img/flags/romania.png" class="nazione-img" data-nazione="romania">
        <!-- hr??? -->
        <img onclick="myFunction(this)" src="./img/flags/scozia.png" class="nazione-img" data-nazione="scozia">
        <img onclick="myFunction(this)" src="./img/flags/serbia.png" class="nazione-img" data-nazione="serbia">
        <img onclick="myFunction(this)" src="./img/flags/slovenia.png" class="nazione-img" data-nazione="slovenia">
        <img onclick="myFunction(this)" src="./img/flags/slovacchia.png" class="nazione-img" data-nazione="slovacchia">
        <!-- hr??? -->
        <img onclick="myFunction(this)" src="./img/flags/spagna.png" class="nazione-img" data-nazione="spagna">
        <img onclick="myFunction(this)" src="./img/flags/svizzera.png" class="nazione-img" data-nazione="svizzera">
        <img onclick="myFunction(this)" src="./img/flags/turchia.png" class="nazione-img" data-nazione="turchia">
        <img onclick="myFunction(this)" src="./img/flags/ucraina.png" class="nazione-img" data-nazione="ucraina">
    </div>

    <?php
    include "./stats/tutti.php";
    ?>

</body>
</html>
