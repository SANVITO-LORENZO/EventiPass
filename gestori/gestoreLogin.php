<?php
require_once("..\classi\users.php");

if(!isset($_SESSION))session_start();


if(!isset($_GET["nome"])||!isset($_GET["password"])){
    header("Location: ..\index.php?messaggio=login non effettuato");
    exit;
}

if(empty($_GET["nome"])||empty($_GET["password"])){
    header("Location: ..\index.php?messaggio=login non effettuato");
    exit;
}

$utenti = new Utenti(); 
$nome = $_GET["nome"];
$password = $_GET["password"];
$risultato= $utenti->isPresente($nome, $password);

if($risultato!="niente"){

    $_SESSION["autenticato"]= $risultato;
    header("Location: indirizzamento.php");  
    exit;
}
else{
    header("Location: ..\index.php?messaggio=login non effettuato");
    exit;
}

?>