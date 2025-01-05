<?php
require_once("gestoreCSV.php");
require_once("../verificalogin.php");

//CONTROLLO CHE SIA UN ORGANIZZATORE
verifica_login("O");

$gestore = new GestoreCSV();
$evento_id = $_POST['evento_id'];
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

if ($evento_id && $nome && $tipologia && $data_inizio && $data_fine && $luogo && $descrizione && $prezzo) {
    try {
        //TUTTI EVENTI DAL FILE
        $eventi = $gestore->ottieni_da_file(__DIR__ . "/../documenti/eventi.csv");
        //FLAG
        $evento_modificato = false;

        //CERCO EVENTO DA MODIFICARE
        foreach ($eventi as $index => $evento) {
            $dati = explode(";", $evento);
            if ($dati[0] == $evento_id && $dati[1] == $_SESSION["username"]) {
                //MODIFICO I DATI DELL'EVENTO
                $dati[2] = $nome;
                $dati[3] = $tipologia;
                $dati[4] = $data_inizio;
                $dati[5] = $data_fine;
                $dati[6] = $luogo;
                $dati[7] = $descrizione;
                $dati[8] = $prezzo;

                //AGGIORNO LE INFORMAZIONI DELL'EVENTO
                $eventi[$index] = implode(";", $dati);
                //FLAG SI MODIFICA
                $evento_modificato = true;
                //FINE DEL FOREACH
                break;
            }
        }

        //SE FLAG
        if ($evento_modificato) {
            // SALVO LE MODIFICHE
            $gestore->salva_su_file(__DIR__ . "/../documenti/eventi.csv", $eventi);
            header("Location: ../organizzatore.php?messaggio=Evento aggiornato con successo!");
        } else {
            header("Location: ../organizzatore.php?messaggio=ERRORE: errore nella modifica");
        }

    } catch (Exception $e) {
        header("Location: ../organizzatore.php?messaggio=ERRORE: errore");
    }
} else {
    header("Location: ../organizzatore.php?messaggio=ERRORE: Dati incompleti.");
}
exit();
?>



