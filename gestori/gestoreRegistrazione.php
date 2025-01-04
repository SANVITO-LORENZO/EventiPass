<?php
require("gestoreCSV.php");
//SE LA SESSIONE NON ESISTE SI CREA
if(!isset($_SESSION))session_start();


//CONTROLLO SE LE VARIABILI SONO SETTATE
if (!isset($_POST['nome']) || !isset($_POST['cognome']) || !isset($_POST['eta'])|| !isset($_POST['cf'])
    || !isset($_POST['mail'])|| !isset($_POST['prefissi'])|| !isset($_POST['numero'])|| !isset($_POST['residenza'])
    || !isset($_POST['carta'])|| !isset($_POST['password'])|| !isset($_POST['ruolo'])) {
    header("Location: registrati.php?messaggio=Errore nei dati inviati.");
    exit();
}

$nome = $_POST['nome'];
$cognome   = $_POST['cognome'];
$eta = $_POST['eta'];
$cf = $_POST['cf'];
$mail = $_POST['mail'];
$prefissi = $_POST['prefissi'];
$numero = $_POST['numero'];
$residenza = $_POST['residenza'];
$carta = $_POST['carta'];
$password = $_POST['password'];
$ruolo = $_POST['ruolo'];
$gestore=new GestoreCSV();

//CONTROLLO CHE LE VARIABILI NON SONO VUOTE
if (empty($nome) || empty($cognome) || empty($eta) ||empty($cf)||empty($mail)||empty($prefissi)
    ||empty($numero)||empty($residenza)||empty($carta)||empty($password)||empty($ruolo)||$eta<18 
    || strlen($numero)!=10||!$gestore->campiNonEsistenti($nome,$cf,$mail,$numero)){
    header("Location: registrati_utente.php?messaggio=Compila tutti i campi.");
    exit();
}


//DOCUMENTO DOVE SONO TENUTE TUTTE LE INFORMAZIONI DI LOGIN
$fileLogin = "..\documenti\login.csv";



//CREO STRINGA NUOVO UTENTE
$nuovo_utente = "$nome;$password;$ruolo";

//AGGIUNGO A FILE
if ($gestore->ottieni_da_file($fileLogin)) {
    $gestore->salva_su_file_append($fileLogin, "\r\n" . $nuovo_utente);
} else {
    $gestore->salva_su_file_append($fileLogin,  $nuovo_utente);
}
$file_utenti="..\documenti\users\utenti.csv";
$nuovo_utente = "$nome;$cognome;$eta;$cf;$mail;$prefissi;$numero;$residenza;$carta";

if($gestore->ottieni_da_file(filename: $file_utenti))
    $gestore->salva_su_file_append($file_utenti, "\r\n" . $nuovo_utente);
else
    $gestore->salva_su_file_append($file_utenti,  $nuovo_utente);
    
header("Location: ..\index.php?messaggio=Registrazione completata con successo.");
exit();
?>
