<?php
require_once("..\classi\users.php");

//SE LA SESSIONE NON ESISTE SI CREA
if(!isset($_SESSION))session_start();

//CONTROLLO SE LE VARIABILI SONO SETTATE
if(!isset($_POST["nome"])||!isset($_POST["password"])){
    header("Location: ..\index.php?messaggio=login non effettuato");
    exit;
}

//CONTROLLO SE LE VARIABILI SONO VUOTE
if(empty($_POST["nome"])||empty($_POST["password"])){
    header("Location: ..\index.php?messaggio=login non effettuato");
    exit;
}

$utenti = new Utenti(); 
$nome = $_POST["nome"];
$_SESSION["username"] = $nome;
$password = $_POST["password"];
//OTTENGO SE UTENTE E VALIDO
$risultato= $utenti->isPresente($nome, $password);

//SE RISULTATO VALIDO
if($risultato!="niente"){

    //CREAZIONE DI VARIABILE DI SESSIONE CON VALORE CHE CORRISPONDE AL TIPO DI UTENTE
    //A -->  AMMINISTRATORE
    //O -->  ORGANIZZATORE
    //U -->  UTENTE
    $_SESSION["autenticato"]= $risultato;
    header("Location: indirizzamento.php");  
    exit;
}
else{
    header("Location: ..\index.php?messaggio=login non effettuato...............");
    exit;
}

?>