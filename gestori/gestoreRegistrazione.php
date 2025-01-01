<?php
//SE LA SESSIONE NON ESISTE SI CREA
if(!isset($_SESSION))session_start();


//CONTROLLO SE LE VARIABILI SONO SETTATE
if (!isset($_POST['nome']) || !isset($_POST['password']) || !isset($_POST['ruolo'])) {
    header("Location: registrati.php?messaggio=Errore nei dati inviati.");
    exit();
}

$nome = $_POST['nome'];
$password = $_POST['password'];
$ruolo = $_POST['ruolo'];

//CONTROLLO CHE LE VARIABILI NON SONO VUOTE
if (empty($nome) || empty($password) || empty($ruolo)) {
    header("Location: ..\registrati.php?messaggio=Compila tutti i campi.");
    exit();
}

//DOCUMENTO DOVE SONO TENUTE TUTTE LE INFORMAZIONI DI LOGIN
$fileLogin = "..\documenti\login.csv";
//PRENDO INFORMAZIONI DA FILE
$contenuto = file_get_contents($fileLogin);
//SEPARO PER "\R\N"
$righe = explode("\r\n", $contenuto);

//PER OGNI RIGA CONTROLLO SE NON ESISTE DI GIA
foreach ($righe as $riga) {
    if (!empty($riga)) {
        $campi = explode(";", $riga);
        if ($campi[0] === $nome) {
            header("Location: ..\index.php?messaggio=Nome utente già esistente.");
            exit();
        }
    }
}

//CREO STRINGA NUOVO UTENTE
$nuovo_utente = "$nome;$password;$ruolo";

//AGGIUNGO A FILE
if ($contenuto) {
    file_put_contents($fileLogin, "\r\n" . $nuovo_utente, FILE_APPEND);
} else {
    file_put_contents($fileLogin, $nuovo_utente, FILE_APPEND);
}
header("Location: ..\index.php?messaggio=Registrazione completata con successo.");
exit();
?>
