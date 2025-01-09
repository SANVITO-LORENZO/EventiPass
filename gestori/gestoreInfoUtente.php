<?php
require_once(__DIR__."/gestoreCSV.php");
require_once(__DIR__."/../classi/prenotazioni.php");
require_once(__DIR__."/../classi/events.php");

require_once(__DIR__."/../verificalogin.php");
//verifico che io abbia la sessione attiva,sia autenticato e se sono autenticato ,lo sno come utente
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
    //legge il file dell'utente

            $gestore=new GestoreCSV();
            $utenti=$gestore->ottieni_da_file(__DIR__."/../documenti/users/utenti.csv");
            foreach($utenti as $utente){
                $campi=explode(';',$utente);//per ogni riga faccio explode 
                if($campi[0]==$_SESSION["username"]){//se sono l'utente che sto cercando
                    echo "Nome: ".$campi[0]."<br>";
                    echo "Cognome: ".$campi[1]."<br>";
                    echo "Eta:".$campi[2]."<br>";
                    echo "Cf: ".$campi[3]."<br>";//stampo tutti i campi dell'utente
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
            $mie_prenotazioni=$prenotazioni->ottieniByNome($_SESSION["username"]);//mi ridà le mie prenotazioni dell'utente
            $miei_eventi=[];
            foreach($mie_prenotazioni as $prenotazione){//data le mie prenotazioni ,prendo le info degli eventi al quale partecipo
               $miei_eventi[]=$eventi->ottieniPerId($prenotazione->getIdEvento());//prendo le info dell'evento al quale sono prenotato
            }   
            //metodo con 2 parametri a-b e se il metodo restituisce 1 li scambia
            function riordina($a, $b) {
                if ($a->getDataFine() < $b->getDataFine()) {
                    return 1; // $a viene prima di $b
                } elseif ($a->getDataFine() > $b->getDataFine()) {
                    return -1; // $a viene dopo $b
                } else {
                    return 0; // $a e $b sono uguali
                }
            }

            usort($miei_eventi, "riordina");//sort eventi per la data fine(vedo prima i futuri)

            $oggi=new DateTime();
            $i=0; //itero fino a che ci sono elementi && finchè la data fine è >della data attuale
            while($i<count($miei_eventi)&& $miei_eventi[$i]->getDataFine()>= $oggi){//itero fino a che le date finali sono > della data attuale
                $evento=$miei_eventi[$i];
                echo $evento->render(false);
                $totale+=$evento->getPrezzo();//aggiorno prezzo speso totale
                $i++;
                //eventi che vanno a finire in eventi futuri
            }
            echo "<h3>eventi passati:</h3>";
            while($i<count($miei_eventi)){//arrivo qua una volta che ho trovato una data vecchia ,ho solo date vecchie,essendo che sono sortate
                $evento=$miei_eventi[$i];
                echo $evento->render(false);//serve al render per togliere il link per prenotarsi 
                $totale+=$evento->getPrezzo();//aggiorno totale speso
                $i++;
            }

            echo "<h3>Totale speso:$totale</h3>"
        ?>
            </div>

            <a href="../utente.php">torna lista eventi</a>
</body>
</html>