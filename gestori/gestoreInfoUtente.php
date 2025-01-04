<?php
require_once(__DIR__."/gestoreCSV.php");

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
    <title>Area personale utente</title>
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
</body>
</html>