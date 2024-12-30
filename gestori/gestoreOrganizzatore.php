<?php
require("gestoreCSV.php");

if (!isset($_SESSION)) session_start();

if (
    !isset($_GET['nome-organizzatore']) || 
    !isset($_GET['pass-organizzatore']) || 
    !isset($_GET['sede']) || 
    !isset($_GET['stato']) || 
    !isset($_GET['mail'])
) {
    header("Location: ..\index.php?messaggio=login non effettuato");
    exit;
}

if (
    empty($_GET['nome-organizzatore']) || 
    empty($_GET['pass-organizzatore']) || 
    empty($_GET['sede']) || 
    empty($_GET['stato']) || 
    empty($_GET['mail'])
) {
    header("Location: ..\index.php?messaggio=login non effettuato");
    exit;
}
         
$nome_organizzatore = $_GET['nome-organizzatore'];
$pass_organizzatore = $_GET['pass-organizzatore'];
$sede = $_GET['sede'];
$stato = $_GET['stato'];
$mail = $_GET['mail'];
        
$riga_csv = "$nome_organizzatore;$pass_organizzatore;$sede;$stato;$mail\r\n";
$file_csv = "../documenti/richieste.csv";

       
$contenuto = file_get_contents($file_csv);
$righe = explode("\r\n", $contenuto);

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
$gestore->salva_su_file_append($file_csv, $riga_csv);

header("location: ../index.php?messaggio=RICHIESTA ORGANIZZATORE INVIATA! ");
     
?>
