<?php
require_once("gestori/gestoreCSV.php");
require_once("verificalogin.php");

// VERIFICO LOGIN
verifica_login("A");

// VERIFICO SE SETTATO
if (!isset($_POST['organizzatore_nome'])) {
    header("Location:amministratore.php?messaggio=ERRORE: errore");
}

$organizzatore_nome = $_POST['organizzatore_nome'];
$file_organizzatori = 'documenti/users/organizzatori.csv';

try {
    $gestore = new GestoreCSV();
    $organizzatori = $gestore->ottieni_da_file($file_organizzatori);
    $dettagli_organizzatore = null;

    // CERCA L'ORGANIZZATORE CON IL NOME PASSATO
    foreach ($organizzatori as $organizzatore) {
        $dati = explode(";", $organizzatore);
        if ($dati[0] == $organizzatore_nome) {
            $dettagli_organizzatore = $dati;
            break;
        }
    }
} catch (Exception $e) {
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettagli Organizzatore</title>
</head>
<body>
    <h1>Dettagli Organizzatore</h1>
    <?php 
    if ($dettagli_organizzatore) {
        echo '<table border="1">';
        echo '<tr>';
        echo '<th>Nome</th>';
        echo '<th>Città</th>';
        echo '<th>Nazione</th>';
        echo '<th>Email</th>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>' . $dettagli_organizzatore[0] . '</td>';
        echo '<td>' . $dettagli_organizzatore[2] . '</td>';
        echo '<td>' . $dettagli_organizzatore[3] . '</td>';
        echo '<td>' . $dettagli_organizzatore[4] . '</td>';
        echo '</tr>';
        echo '</table>';
    }
    ?>
    <a href="amministratore.php">
        <button>Torna alla pagina amministratore</button>
    </a>
</body>
</html>
