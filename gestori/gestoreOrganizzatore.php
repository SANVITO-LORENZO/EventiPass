<?php
require("gestoreCSV.php");
require_once(__DIR__."/../verificalogin.php");
verifica_sessione();

//CONTROLLO SE TUTTE LE VARIABILI SONO STATE SETTATE
if (
    !isset($_POST['nome-organizzatore']) || 
    !isset($_POST['pass-organizzatore']) || 
    !isset($_POST['sede']) || 
    !isset($_POST['stato']) || 
    !isset($_POST['mail'])
) {
    header("Location: ..\index.php?messaggio=login non effettuato");
    exit;
}

//CONTROLLO CHE LE VARIABILI NON SIANO VUOTE
if (
    empty($_POST['nome-organizzatore']) || 
    empty($_POST['pass-organizzatore']) || 
    empty($_POST['sede']) || 
    empty($_POST['stato']) || 
    empty($_POST['mail'])
) {
    header("Location: ..\index.php?messaggio=login non effettuato");
    exit;
}
         
$nome_organizzatore = $_POST['nome-organizzatore'];
$pass_organizzatore = $_POST['pass-organizzatore'];
$sede = $_POST['sede'];
$stato = $_POST['stato'];
$mail = $_POST['mail'];
    
//STRINGA INFORMAZIONI
$riga_csv = "$nome_organizzatore;$pass_organizzatore;$sede;$stato;$mail\r\n";
//PATH FILE
$file_richieste = "../documenti/richieste.csv";

//OTTENGO E SEPARO IL CONTENUTO
$contenuto = file_get_contents($file_richieste);
$righe = explode("\r\n", $contenuto);

//CONTROLLO PER OGNI RIGA SE NON E' GIA PRESENTE IL NOME
foreach ($righe as $riga) {
   if (!empty($riga)) {
        $campi = explode(";", $riga);
        if ($campi[0] === $nome_organizzatore) {
            header("Location:registrati_organizzatore.php?messaggio=Nome utente già esistente!");
            exit();
            }
        }
}

$gestore=new GestoreCSV();
//AGGIUNGO RICHIESTA
$gestore->salva_su_file_append($file_richieste, $riga_csv);

header("location: ../index.php?messaggio=RICHIESTA ORGANIZZATORE INVIATA! ");
     
?>
