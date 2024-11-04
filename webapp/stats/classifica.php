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
        <link rel="stylesheet" href="../../css/style.css?v=1012">
        <link rel="stylesheet" href="../font/css/cabinet-grotesk.css">
    </head>
    
    
    <body style="text-align: center;">

        <div class="box-high">
            <span class="title-high">Classifica</span>
            <div class="classifica">
        <!-- CHIAMATA -->
        <?php

            // locale che va in errore fai check poi
            $hName = 'localhost'; // host
            $uName = 'veytkbae_wp885'; // user
            $password = 'Ciaociam23.'; // psw
            $dbName = 'veytkbae_wp885'; // db

            // conn
            $dbCon = new mysqli($hName, $uName, $password, $dbName);

            // check
            if ($dbCon->connect_error) {
                die("Connessione al database fallita: " . $dbCon->connect_error);
            }
            
            $run = mysqli_query($dbCon,"SELECT * FROM classifica_lega order by punti DESC");
            $i=1;  
            if ($num = mysqli_num_rows($run)>0) {  
                while ($row = mysqli_fetch_assoc($run)) { 
                    echo "<div class='pos'>
                            <span class='squadra'>" . $row['nome'] . "</span>
                            <span class='punti'>" . $row['punti'] . "p</span>
                        </div>";
                }
            }  
            echo "</div>";
        
        ?>
        
        </div>

        <a class="collegamento" href="https://fantaeuropei.netsons.org/webapp/index.php">HOME</a>
        

        
    </body>

</script>
</html>