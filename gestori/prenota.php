<?php
require_once(__DIR__."/../classi/events.php");
require_once(__DIR__."/../classi/prenotazioni.php");

require_once(__DIR__."/../verificalogin.php");

//SE LA SESSIONE NON ESISTE SI CREA E VERIFICA LOGIN CON RUOLO CORRETTO
verifica_login("U");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $nome_file=__DIR__."/../documenti/prenotazioni.csv";
        $e=new Eventi();
    
        $event=$e->ottieniPerId($_GET["IdEvento"]);
        $prenotazioni=new Prenotazioni();
        $contenuto= !$prenotazioni->verificaEsistenza($_SESSION["username"],$event->getId());
        echo $event->toCsv()."<br>";
        if($contenuto)
            $prenotazioni->creaPrenotazione( $_SESSION["username"],$event->getId());
        else
        {
            echo "Hai già prenotato l'evento";
        }
    ?>
    <br>
    <a href="../utente.php">Torna alla lista eventi</a>
</body>
</html>