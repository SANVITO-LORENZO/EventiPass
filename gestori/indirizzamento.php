<?php
if(!isset($_SESSION))session_start();


if(isset($_SESSION["autenticato"])){
    if($_SESSION["autenticato"]== "U")
        header("Location: ..\utente.php");
    else if($_SESSION["autenticato"]== "O")
        header("Location: ..\organizzatore.php");
    else if($_SESSION["autenticato"]== "A")
        header("Location: ..\amministratore.php");
    exit;
}
?>