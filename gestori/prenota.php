<?php
require_once(__DIR__."/../classi/events.php");
require_once(__DIR__."/../classi/prenotazioni.php");

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
    <?php
        $nome_file=__DIR__."/../documenti/prenotazioni.csv";
        $e=new Eventi();
    
        $event=$e->ottieniPerNome($_GET["NomeEvento"]);
        $prenotazioni=new Prenotazioni();
        $contenuto= !$prenotazioni->verificaEsistenza($_SESSION["username"],$event->getNome());
        echo $event->toCsv()."<br>";
        if(!$contenuto)
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