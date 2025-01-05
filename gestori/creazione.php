<?php
require_once('../classi/events.php');

require_once(__DIR__."/../verificalogin.php");
verifica_login("O");

//CONTROLLO SE LE VARIABILI SONO SETTATE
if (!isset($_POST['nome']) || !isset($_POST['tipologia']) || !isset($_POST['data_inizio']) || !isset($_POST['data_fine']) || !isset($_POST['luogo']) || !isset($_POST['descrizione']) || !isset($_POST['prezzo'])) {
    header("Location: ../organizzatore.php?messaggio=ERRORE: errore nei dati inviati.");
    exit();
}

$nome = $_POST['nome'];
$tipologia = $_POST['tipologia'];
$data_inizio = $_POST['data_inizio'];
$data_fine = $_POST['data_fine'];
$luogo = $_POST['luogo'];
$descrizione = $_POST['descrizione'];
$prezzo = $_POST['prezzo'];

//CONTROLLO CHE LE VARIABILI NON SONO VUOTE
if (empty($nome) || empty($tipologia) || empty($data_inizio) || empty($data_fine) || empty($luogo) || empty($descrizione) || empty($prezzo)) {
    header("Location: ../organizzatore.php?messaggio=ERRORE: compila tutti i campi.");
    exit();
}

// CONTROLLO SUL FORMATO DEL PREZZO
if ($prezzo < 0) {
    header("Location: ../organizzatore.php?messaggio=ERRORE: il prezzo deve essere maggiore di zero.");
    exit();
}

//CREO OGGETTI FATETIME PER FARCI I CONTROLLI
$tmp1 = new DateTime($data_inizio);
$tmp2 = new DateTime($data_fine);
$oggi = new DateTime();


// CONTROLLO CHE LA DATA DI INIZIO SIA FUTURA
if ($tmp1 <= $oggi) {
    header("Location: ../organizzatore.php?messaggio=ERRORE: la data di inizio errata");
    exit();
}

// CONTROLLO CHE DATA DI INIZIO SIA PRIMA DELLA DATA DI FINE
if ($tmp1 >= $tmp2) {
    header("Location: ../organizzatore.php?messaggio=ERRORE: data di inizio deve essere precedente alla data di fine.");
    exit();
}

//CHIAMATA AL METODO PER CREARE L'EVENTO E AGGIUNGERLO AL FILE CSV
$eventi = new Eventi();
$creatore = $_SESSION["username"];
$eventi->creaEvento($creatore, $nome, $tipologia, $data_inizio, $data_fine, $luogo, $descrizione, $prezzo);

//REINDIRIZZAMENTO
header("Location: ../organizzatore.php?messaggio=ERRORE: Evento creato con successo.");
exit();
?>
