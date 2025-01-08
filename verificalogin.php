<?php

    function verifica_sessione(){//verifico che ho la sessione attiva,se è no me la avvia
        if(!isset($_SESSION))session_start();
    }
    function verifica_accesso(){
        //CONTROLLO SE LA VARIABILE DI SESSIONE AUTENTICATO E' ESISTENTE
        if(!isset($_SESSION["autenticato"])){
            header("location: index.php?messaggio=errore");
            exit;
        }
    }//verifico che ho fatto l'accesso e controlla il ruolo
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

    function redirect($errore){//ridirige 
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
                header("Location: ../utente.php".$errore);
                exit;
            } 
            else if($_SESSION["autenticato"]== "O")
            {
                header("Location: ../organizzatore.php".$errore);
                exit;
            }
            else if($_SESSION["autenticato"]== "A")
            {
                header("Location: ../amministratore.php".$errore);
                exit;
            }
        }
    }

?>