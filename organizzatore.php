<?php

//SE LA SESSIONE NON ESISTE SI CREA
if(!isset($_SESSION)) session_start();

//CONTROLLO SE LA VARIABILE DI SESSIONE AUTENTICATO E' ESISTENTE
if(!isset($_SESSION["autenticato"])){
    header("location: index.php?messaggio=errore");
    exit;
}

//A -->  AMMINISTRATORE
//O -->  ORGANIZZATORE
//U -->  UTENTE
//CONTROLLO SE AUTENTICATO NON CORRISPONDE AD O MANDO A PAGINA INDEX
if($_SESSION["autenticato"]!="O"){
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
    <h1>PAGINA ORGANIZZATORE</h1>
    <h2>
        <?php
        //MOSTRA IL NOME DI CHI E LOGGATO
        echo 'benvenuto  '.$_SESSION["username"];
        ?>
    </h2>
    <!-- BOTTONE CHE GESTISCE IL LOGOUT -->
    <form action="gestori\gestoreLogout.php">
        <button>LOGOUT</button>
    </form>
</body>
</html>