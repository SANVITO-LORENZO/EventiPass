<?php
require_once("gestoreCSV.php");

if(!isset($_SESSION))session_start();

$nome = $_GET['nome'];
$azione = $_GET['azione'];

if (!isset($_GET['nome']) || !isset($_GET['azione'])){
    header("Location: ../index.php?messaggio=Errore con comando amministratore");
    exit();
}

if (empty($nome) || empty($azione)) {
    header("Location: ../index.php?messaggio=Errore con comando amministratore");
    exit();
}


$fileRichieste = '../documenti/richieste.csv';
$fileOrganizzatori = '../documenti/users/organizzatori.csv';

    try {
        $gestore = new GestoreCSV();
        $righeRichieste = $gestore->ottieni_da_file($fileRichieste);
        $righeAggiornate = [];
        $rigaSpostata = null;

        foreach ($righeRichieste as $riga) {
            if (!empty($riga)) {
                $campi = explode(";", $riga);
                if (count($campi) >= 5 && $campi[0] === $nome) {
                    $rigaSpostata = $riga;
                } else {
                    $righeAggiornate[] = $riga;
                }
            }
        }

        if ($rigaSpostata && $azione === 'accetta') {
            file_put_contents($fileOrganizzatori, $rigaSpostata . "\n", FILE_APPEND);
        }
        file_put_contents($fileRichieste, implode("\r\n", $righeAggiornate));

        echo "<h1>Azione completata</h1>";
        echo "<p>La richiesta di " . htmlspecialchars($nome) . " è stata " . ($azione === 'accetta' ? 'accettata e aggiunta agli organizzatori' : 'rifiutata e rimossa dalle richieste') . ".</p>";
        echo "<a href='../amministratore.php'>Torna alla pagina amministratore</a>";

    } catch (Exception $e) {
    }
?>
