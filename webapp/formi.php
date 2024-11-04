<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <title>FantaEuropei</title>
        <meta name="viewport" content="width=device-width; initial-scale=1.0; user-scalable=no" />
        <link rel="stylesheet" href="./../css/style.css?v=3.1">
        <link rel="stylesheet" href="./font/css/cabinet-grotesk.css">

        <style>
        h1 {
            margin-top: 40px;
            margin-bottom: -30px;
            text-align: left;
            padding-left: 40px;
            font-family: 'CabinetGrotesk-Black';
        }
        .img-scontri{
            width: 80px;
        }
        ul {
            display: flex;
            flex-direction: column-reverse;
            flex-wrap: nowrap;
            align-items: center;
            justify-content: center;
            list-style: none;
            font-family: 'CabinetGrotesk-Bold';
            margin: 0;
            padding: 0;
            text-align: left;
        }
        li {
            display: flex;
            flex-direction: row-reverse;
            flex-wrap: nowrap;
            padding: 20px;
        }
        .title-gior {
            font-size: 33px;
            display: block;
            margin-left: -29px;
        }
        .result {
            font-size: 30px;
            padding: 20px;
        }
        </style>
    </head>
    
    
    <body style="text-align: center;">

        <img src="./img/banner-formi.png" class="banner">
        <img src="./img/squadre/formi.png" class="banner-logo">
        <img src="./img/shape.png" style="width: 100%; margin-top: 15px;">

        <h1 class="title-squadra" style="font-size: 30px">FORMIGANG</h1>

        <?php
        $pagina_corrente = basename($_SERVER['PHP_SELF']);
        $nome_utente = str_replace('.php', '', $pagina_corrente);
        ?>
        <a href="./partite/gironi.php?nome_utente=<?php echo $nome_utente; ?>"><img class="banner-giornate" src="./img/gironi.png" style="margin-top: 30px"></a>
        <a href="./partite/gironi2.php?nome_utente=<?php echo $nome_utente; ?>"><img class="banner-giornate" src="./img/gironi2.png"></a>
        <a href="./partite/gironi3.php?nome_utente=<?php echo $nome_utente; ?>"><img class="banner-giornate" src="./img/gironi3.png"></a>
        <a href="./partite/ottavi.php?nome_utente=<?php echo $nome_utente; ?>"><img class="banner-giornate" src="./img/ottavi.png"></a>
        <a href="./partite/quarti.php?nome_utente=<?php echo $nome_utente; ?>"><img class="banner-giornate" src="./img/quarti.png"></a>
        <a href="./partite/semi.php?nome_utente=<?php echo $nome_utente; ?>"><img class="banner-giornate" src="./img/semifinali.png"></a>
        <a href="./partite/finali.php?nome_utente=<?php echo $nome_utente; ?>"><img class="banner-giornate" src="./img/finali.png"></a>

        <br>

        <?php //include "./stats/giornate.php";?>
        <h1>Rosa ;)</h1>
        <div class="box-high" style="margin: 0; margin-top: 30px; background: none; box-shadow: none;">
            <div class="classifica">
                <?php include "./stats/prendigiocatoridai.php";?>
            </div>
        </div>
        
    </body>

    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  
<script>
//versione 1.2
</script>
</html>