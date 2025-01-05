<?php
require_once("gestoreCSV.php");
require_once("../verificalogin.php");

//VERIFICO SE ORGANIZZATORE
verifica_login("O");

$gestore = new GestoreCSV();

//CONTROLLO SE SETTATO
if (!isset($_POST['evento_id'])) {
    header("Location: ..\organizzatore.php?messaggio=ERRORE: errore");
    exit;
}

$evento_id = $_POST['evento_id'];

if ($evento_id) {
    try {
        $eventi = $gestore->ottieni_da_file(__DIR__ . "/../documenti/eventi.csv");
        //FLAG
        $evento_trovato = null;
        //CERCO EVENTO DELL'ID
        foreach ($eventi as $evento) {
            $dati = explode(";", $evento);
            if ($dati[0] == $evento_id && $dati[1] == $_SESSION["username"]) {
                $evento_trovato = $dati;
                break;
            }
        }

        if ($evento_trovato) {
            //SE TROVATO MOSTRO PAGINA PER MODIFICARE CON INFORMAZIONI GIA PRESENTI
?>
            <h3>Modifica Evento</h3>
            <form action="aggiorna_evento.php" method="POST">
                <input type="hidden" name="evento_id" value="<?php echo $evento_trovato[0]; ?>">

                <label>Nome Evento:</label>
                <input type="text" name="nome" value="<?php echo $evento_trovato[2]; ?>" required>
                <br><br>
                <label>Tipologia Evento:</label>
                <input type="text" name="tipologia" value="<?php echo $evento_trovato[3]; ?>" required>
                <br><br>
                <label>Data Inizio:</label>
                <input type="datetime-local" name="data_inizio" value="<?php echo $evento_trovato[4]; ?>" required>
                <br><br>
                <label>Data Fine:</label>
                <input type="datetime-local" name="data_fine" value="<?php echo $evento_trovato[5]; ?>" required>
                <br><br>
                <label>Luogo:</label>
                <input type="text" name="luogo" value="<?php echo $evento_trovato[6]; ?>" required>
                <br><br>
                <label>Descrizione:</label>
                <textarea name="descrizione" required><?php echo $evento_trovato[7]; ?></textarea>
                <br><br>
                <label>Prezzo:</label>
                <input type="number" name="prezzo" value="<?php echo $evento_trovato[8]; ?>" required>
                <br><br>
                <button type="submit">Salva Modifiche</button>
            </form>
            <?php
        } else {
            header("Location: ../organizzatore.php?messaggio=ERRORE: errore");
            exit;
        }
    } catch (Exception $e) {
        header("Location: ../organizzatore.php?messaggio=ERRORE: errore");
        exit;    }
} else {
    header("Location: ../organizzatore.php?messaggio=ERRORE: errore");
    exit;}
?>
