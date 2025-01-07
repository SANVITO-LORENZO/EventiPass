<?php
require_once(__DIR__."/gestoreCSV.php");
require_once(__DIR__."/../classi/prenotazioni.php");
require_once(__DIR__."/../classi/events.php");

require_once(__DIR__."/../verificalogin.php");
verifica_login("U");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area personale utente</title>
    <link rel="stylesheet" href="../grafica/utente.css">
</head>
<body>
    <?php
            $gestore=new GestoreCSV();
            $utenti=$gestore->ottieni_da_file(__DIR__."/../documenti/users/utenti.csv");
            foreach($utenti as $utente){
                $campi=explode(';',$utente);
                if($campi[0]==$_SESSION["username"]){
                    echo "Nome: ".$campi[0]."<br>";
                    echo "Cognome: ".$campi[1]."<br>";
                    echo "Eta:".$campi[2]."<br>";
                    echo "Cf: ".$campi[3]."<br>";
                    echo "Mail: ".$campi[4]."<br>";
                    echo "Prefissi: ".$campi[5]."<br>";
                    echo "numero: ".$campi[6]."<br>";
                    echo "residenza: ".$campi[7]."<br>";
                    echo "Carta: ".$campi[8]."<br>";
                    echo "<hr>";
                    break;
                }
            }
            ?>

            <div>
                <h2>prenotazioni fatte:</h2>
                <h3>eventi futuri:</h3>
        <?php
            $prenotazioni=new Prenotazioni();
            $eventi=new Eventi();
            $totale=0;
            $mie_prenotazioni=$prenotazioni->ottieniByNome($_SESSION["username"]);
            $miei_eventi=[];
            foreach($mie_prenotazioni as $prenotazione){
               $miei_eventi[]=$eventi->ottieniPerId($prenotazione->getIdEvento());
            }   
            usort($miei_eventi, fn($a, $b) => $a->getDataFine()< $b->getDataFine());
            $oggi=new DateTime();
            $i=0;
            while($i<count($miei_eventi)&& $miei_eventi[$i]->getDataFine()>= $oggi){
                $evento=$miei_eventi[$i];
                echo $evento->render(false);
                $totale+=$evento->getPrezzo();
                $i++;
            }
            echo "<h3>eventi passati:</h3>";
            while($i<count($miei_eventi)){
                $evento=$miei_eventi[$i];
                echo $evento->render(false);
                $totale+=$evento->getPrezzo();
                $i++;
            }

            echo "<h3>Totale speso:$totale</h3>"
        ?>
            </div>

            <a href="../utente.php">torna lista eventi</a>
</body>
</html>