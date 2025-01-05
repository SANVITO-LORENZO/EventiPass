<?php
require("gestoreCSV.php");
require_once(__DIR__."/../verificalogin.php");
verifica_sessione();

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


// CONTROLLO NOME E COGNOME
if (empty($nome) || !preg_match("/^[a-zA-Z0-9\s'-]+$/", $nome)) {
    $messaggioErrore = "Nome non valido.";
} elseif (empty($cognome) || !preg_match("/^[a-zA-Z0-9\s'-]+$/", $cognome)) {
    $messaggioErrore = "Cognome non valido.";
}

// CONTROLLO ETA
elseif ($eta < 18 || $eta > 120) {
    $messaggioErrore = "Età non valida. Deve essere maggiore di 18 anni.";
}

// CONTROLLO ALMENO 16 CIFRE CODICE FISCALE
elseif (strlen($cf) != 16 || !preg_match("/^[A-Z0-9]{16}$/", $cf)) {
    $messaggioErrore = "Codice fiscale non valido.";
}

// CONTROLLO EMAIL
elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    $messaggioErrore = "Email non valida.";
}

// CONTROLLO SE NUMERO HA ALMENO 10 CIFRE
elseif (!preg_match("/^\d{10}$/", $numero)) {
    $messaggioErrore = "Numero di telefono non valido. Deve contenere esattamente 10 cifre.";
}

// RCONTROLLO RESIDENZA
elseif (empty($residenza)) {
    $messaggioErrore = "Residenza non valida.";
}

// CONTROLLO SE NUMERO DELLA CARTA HA ALMENO 16 CIFRE
elseif (!preg_match("/^\d{16}$/", $carta)) {
    $messaggioErrore = "Numero di carta non valido. Deve contenere esattamente 16 cifre.";
}

//SE ERRORE PRESENTE
if ($messaggioErrore) {
    header("Location: ../index.php?messaggio=$messaggioErrore");
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
