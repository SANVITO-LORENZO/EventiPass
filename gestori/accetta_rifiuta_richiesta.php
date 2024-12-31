<?php
require_once("gestoreCSV.php");

if(!isset($_SESSION)) session_start();

$nome = isset($_GET['name']) ? $_GET['name'] : '';
$azione = isset($_GET['azione']) ? $_GET['azione'] : '';

if (empty($nome) || empty($azione)) {
    header("Location: ../index.php?messaggio=Errore con comando amministratore");
    exit();
}

$fileRichieste = '../documenti/richieste.csv';
$fileOrganizzatori = '../documenti/users/organizzatori.csv';
$fileLogin = '../documenti/login.csv';

try {
    $gestore = new GestoreCSV();

    // Ottieni le righe dal file delle richieste
    $righeRichieste = $gestore->ottieni_da_file($fileRichieste);

    $righeAggiornate = [];
    $rigaSpostata = null;
    $password = null;

    foreach ($righeRichieste as $riga) {
        if (!empty($riga)) {
            $campi = explode(";", $riga);
            if (count($campi) >= 5 && $campi[0] === $nome) {
                // Trovata la riga corrispondente
                $rigaSpostata = $riga;
                $password = $campi[1]; // Secondo campo è la password
            } else {
                $righeAggiornate[] = $riga;
            }
        }
    }

    if ($rigaSpostata) {
        if ($azione === 'accetta') {
            // Aggiungi la riga al file degli organizzatori
            if (!file_exists($fileOrganizzatori)) {
                file_put_contents($fileOrganizzatori, ""); // Crea il file se non esiste
            }
            file_put_contents($fileOrganizzatori, $rigaSpostata . "\n", FILE_APPEND);

            // Aggiungi il nome, la password e "O" al file login.csv
            $nuovaRigaLogin = "$nome;$password;O\n";

            // Verifica se il file login.csv esiste
            if (!file_exists($fileLogin)) {
                file_put_contents($fileLogin, $nuovaRigaLogin); // Crea il file con la nuova riga
            } else {
                // Leggi il contenuto esistente, separa correttamente e aggiungi la nuova riga
                $contenutoLogin = file_get_contents($fileLogin);
                $contenutoLogin .= $nuovaRigaLogin; // Aggiungi la nuova riga separata correttamente
                file_put_contents($fileLogin, $contenutoLogin);
            }
        }
    }
    file_put_contents($fileRichieste, implode("\n", $righeAggiornate));

    echo "<h1>Azione completata</h1>";
    echo "<p>La richiesta di " . htmlspecialchars($nome) . " è stata " . ($azione === 'accetta' ? 'accettata e aggiunta agli organizzatori e login.csv' : 'rifiutata e rimossa dalle richieste') . ".</p>";
    echo "<a href='../amministratore.php'>Torna alla pagina amministratore</a>";

} catch (Exception $e) {
    die("Errore: " . htmlspecialchars($e->getMessage()));
}
?>
