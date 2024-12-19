<?php
if(!isset($_SESSION))session_start();


if(isset($_SESSION["autenticato"])){
    if($_SESSION["autenticato"]== "utente")
        header("Location: utente.php");
    else if($_SESSION["autenticato"]== "organizzatore")
        header("Location: organizzatore.php");
    else if($_SESSION["autenticato"]== "amministratore")
        header("Location: amministratore.php");
    exit;
}
?>