<?php
require_once("gestori/gestoreCSV.php");
require_once("verificalogin.php");

//VERIFICO LOGIN
verifica_login("A");

//VERIFICO SE SETTATO
if (!isset($_POST['utente_nome'])) {
    header("Location:amministratore.php?messaggio=ERRORE: errore");
}

$utente_nome = $_POST['utente_nome'];
$file_utenti = 'documenti/users/utenti.csv';

try {
    $gestore = new GestoreCSV();
    $utenti = $gestore->ottieni_da_file($file_utenti);
    $dettagli_utente = null;

    //CERCA L'UTENTE CON L'ID PASSATO
    foreach ($utenti as $utente) {
        $dati = explode(";", $utente);
        if ($dati[0] == $utente_nome) {
            $dettagli_utente = $dati;
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
    <title>Dettagli Utente</title>
</head>
<body>
    <h1>Dettagli Utente</h1>
    <table border="1">
        <tr>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Età</th>
            <th>Codice Fiscale</th>
            <th>Email</th>
            <th>Prefisso</th>
            <th>Telefono</th>
            <th>Indirizzo</th>
            <th>Numero Carta</th>
        </tr>
        <tr>
            <td><?php echo $dettagli_utente[0]; ?></td>
            <td><?php echo $dettagli_utente[1]; ?></td>
            <td><?php echo $dettagli_utente[2]; ?></td>
            <td><?php echo $dettagli_utente[3]; ?></td>
            <td><?php echo $dettagli_utente[4]; ?></td>
            <td><?php echo $dettagli_utente[5]; ?></td>
            <td><?php echo $dettagli_utente[6]; ?></td>
            <td><?php echo $dettagli_utente[7]; ?></td>
            <td><?php echo $dettagli_utente[8]; ?></td>
        </tr>
    </table>
    <a href="amministratore.php">
        <button>Torna alla pagina amministratore</button>
    </a>
</body>
</html>
