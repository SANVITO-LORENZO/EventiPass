<?php
//non usata!

//SE LA SESSIONE NON ESISTE SI CREA
if(!isset($_SESSION))session_start();

//CONTROLLO SE LA VARIABILE DI SESSIONE AUTENTICATO CI SIA
if(isset($_SESSION["autenticato"])){

//IN BASE AL VALORE INDIRIZZO SULLA PAGINA CORRISPONDENTE
//A -->  AMMINISTRATORE
//O -->  ORGANIZZATORE
//U -->  UTENTE

    if($_SESSION["autenticato"]== "U")
        header("Location: ..\utente.php");

    else if($_SESSION["autenticato"]== "O")
        header("Location: ..\organizzatore.php");
    
    else if($_SESSION["autenticato"]== "A")
        header("Location: ..\amministratore.php");
    exit;
}
?>