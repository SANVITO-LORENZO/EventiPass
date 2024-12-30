<?php

if(!isset($_SESSION))session_start();

if (!isset($_GET['nome']) || !isset($_GET['password']) || !isset($_GET['ruolo'])) {
    header("Location: ../registrati.php?messaggio=Errore nei dati inviati.");
    exit();
}

$nome = $_GET['nome'];
$password = $_GET['password'];
$ruolo = $_GET['ruolo'];

if (empty($nome) || empty($password) || empty($ruolo)) {
    header("Location: ../registrati.php?messaggio=Compila tutti i campi.");
    exit();
}


$users_file = "..\documenti\login.csv";
$contenuto = file_get_contents($users_file);
$righe = explode("\r\n", $contenuto);

foreach ($righe as $riga) {
    if (!empty($riga)) {
        $campi = explode(";", $riga);
        if ($campi[0] === $nome) {
            header("Location: ../index.php?messaggio=Nome utente già esistente.");
            exit();
        }
    }
}


$nuovo_utente = "$nome;$password;$ruolo";
if ($contenuto) {
    file_put_contents($users_file, "\r\n" . $nuovo_utente, FILE_APPEND);
} else {
    file_put_contents($users_file, $nuovo_utente, FILE_APPEND);
}
header("Location: ../index.php?messaggio=Registrazione completata con successo.");
exit();








//AGGIUNGI FUNZIONE CHE SALVA TUTTE LE INFORMAZIONI DELL UTENTE NELLA CARTELLA ..//documenti/users/utenti.csv
//QUA AGGIUNGI TUTTE LE INFORMAZIONI DELL'UTENTE QUELLE DELLA LISTA
// - NOME
// - COGNOME
// - ETA (MAGGIORE 18)
// - CF (CONTROLLO SE NON ESISTE DI GIA)
// - MAIL ( CONTROLLO SE NON ESISTE DI GIA)
// - PREFISSI (PRESI DA FILE)
// - NUMERO	(CONTROLLO SE HA 10 NUMERI)		      
// - RESIDENZA	      --> CITTA/ VIA / NUMERO / CAP	
// - *CARTA (VEDIAMO POI) --> CVV / SCADENZA / NUMERO

// - USERNAME
// - PASSWORD1
// - PASSWORD2

//FAI COME AVEVAMO VISTO IN CLASSE O ALMENO PROVACI DI METTERE LE DUE PASSWORD E DI CONTROLLARLE CON IL JAVASCRIPT


//IO FARO LA STESSA COSA PER ORGANIZZATORI E DOPO ADMIN POTRA VISUALIZZARE QUESTE INFORMAZIONI
?>
