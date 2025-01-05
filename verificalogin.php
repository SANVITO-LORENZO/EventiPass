<?php

    function verifica_sessione(){
        if(!isset($_SESSION))session_start();
    }
    function verifica_accesso(){
        //CONTROLLO SE LA VARIABILE DI SESSIONE AUTENTICATO E' ESISTENTE
        if(!isset($_SESSION["autenticato"])){
            header("location: index.php?messaggio=errore");
            exit;
        }
    }
    function verifica_login($ruolo){
        verifica_sessione();
        verifica_accesso();
        //A -->  AMMINISTRATORE
        //O -->  ORGANIZZATORE
        //U -->  UTENTE
        //CONTROLLO SE AUTENTICATO NON CORRISPONDE AD U MANDO A PAGINA INDEX
        if($_SESSION["autenticato"]!=$ruolo){
            //header("location: index.php?messaggio=errore");
            redirect("accesso negato");
            exit;
        }
    }

    function redirect($errore){
        if(isset($_SESSION["autenticato"])){

            //IN BASE AL VALORE INDIRIZZO SULLA PAGINA CORRISPONDENTE
            //A -->  AMMINISTRATORE
            //O -->  ORGANIZZATORE
            //U -->  UTENTE
            if(!isset($errore))
                $errore="";
            else
                $errore="?messaggio=".$errore;
            if($_SESSION["autenticato"]== "U")
            {
                header("Location: /EventiPass-main/utente.php".$errore);
                exit;
            } 
            else if($_SESSION["autenticato"]== "O")
            {
                header("Location: /EventiPass-main/organizzatore.php".$errore);
                exit;
            }
            else if($_SESSION["autenticato"]== "A")
            {
                header("Location: /EventiPass-main/amministratore.php".$errore);
                exit;
            }
        }
    }

?>