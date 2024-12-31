<?php
require_once("classi/events.php");

//SE LA SESSIONE NON ESISTE SI CREA
if(!isset($_SESSION))session_start();

//CONTROLLO SE LA VARIABILE DI SESSIONE AUTENTICATO E' ESISTENTE
if(!isset($_SESSION["autenticato"])){
    header("location: index.php?messaggio=errore");
    exit;
}

//A -->  AMMINISTRATORE
//O -->  ORGANIZZATORE
//U -->  UTENTE
//CONTROLLO SE AUTENTICATO NON CORRISPONDE AD U MANDO A PAGINA INDEX
if($_SESSION["autenticato"]!="U"){
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
    
    <!-- BOTTONE CHE GESTISCE IL LOGOUT -->
    <form action="gestori\gestoreLogout.php">
        <button>LOGOUT</button>
    </form>
</body>
</html>