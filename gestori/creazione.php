<?php
require_once('../classi/events.php');

//SE LA SESSIONE NON ESISTE SI CREA
if (!isset($_SESSION)) session_start();

//CONTROLLO SE LE VARIABILI SONO SETTATE
if (!isset($_POST['nome']) || !isset($_POST['tipologia']) || !isset($_POST['data_inizio']) || !isset($_POST['data_fine']) || !isset($_POST['luogo']) || !isset($_POST['descrizione']) || !isset($_POST['prezzo'])) {
    header("Location: ../organizzatore.php?messaggio=Errore nei dati inviati.");
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
    header("Location: ../organizzatore.php?messaggio=Compila tutti i campi.");
    exit();
}

// CHIAMATA AL METODO PER CREARE L'EVENTO E AGGIUNGERLO AL FILE CSV

$eventi = new Eventi();
$creatore = $_SESSION["username"]; // Il creatore dell'evento è l'utente loggato
$eventi->creaEvento($creatore, $nome, $tipologia, $data_inizio, $data_fine, $luogo, $descrizione, $prezzo);

//Reindirizza alla pagina di successo o alla lista eventi
header("Location: ../organizzatore.php?messaggio=Evento creato con successo.");
exit();
?>
