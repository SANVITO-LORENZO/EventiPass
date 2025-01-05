<?php
require_once("..\classi\users.php");
require_once(__DIR__."/../verificalogin.php");
verifica_sessione();

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
    redirect("");
    exit;
}
else{
    header("Location: ..\index.php?messaggio=login non effettuato...............");
    exit;
}

?>