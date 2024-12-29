<?php

require_once("classi/events.php");
if(!isset($_SESSION))session_start();

if(!isset($_SESSION["autenticato"])){
    header("location: index.php?messaggio=errore");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>UTENTE BASE</h1>
    <?php
        $file_eventi=new Events();
        foreach($file_eventi->getEventsByTipologia("") as $eventi){
            echo "<div>";
            echo "Creatore: ".$eventi->getCreatore()."<br>";
            echo "Nome: ".$eventi->getNome()."<br>";
            echo "Tipologia: ".$eventi->getTipologia()."<br>";
            echo "DataInizio: ".$eventi->getDataInizio()."<br>";
            echo "Data fine: ".$eventi->getDataFine()."<br>";
            echo "Luogo: ".$eventi->getLuogo()."<br>";
            echo "Descrizione: ".$eventi->getDescrizione()."<br>";
            echo "Prezzo: ".$eventi->getPrezzo()."<br>";
            echo "<a href='gestori/prenota.php?NomeEvento=".$eventi->getNome()."'>prenotati</a>";
            echo "<hr>";
            echo "</div>";
        }
    ?>

    <form action="gestori\gestoreInfoUtente.php">
        <button>Area personale</button>
    </form>
    
    <form action="gestori\gestoreLogout.php">
        <button>LOGOUT</button>
    </form>
</body>
</html>