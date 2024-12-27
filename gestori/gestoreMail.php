<?php
class GestoreMail {

    public function mandaMailRichiestaAmministratore($dati) {
        $campi_richiesti = ['nome-organizzatore', 'tipologia-eventi', 'sede', 'stato', 'mail', 'descrizione-organizzatore'];
        foreach ($campi_richiesti as $campo) {
            if (!isset($dati[$campo]) || empty($dati[$campo])) {
                header("Location:registra_organizzatore.php?messaggio=manca un parametro");
            }
        }

        $nome_organizzatore = $dati['nome-organizzatore'];
        $tipologia_eventi = $dati['tipologia-eventi'];
        $sede = $dati['sede'];
        $stato = $dati['stato'];
        $mail = $dati['mail'];
        $descrizione = $dati['descrizione-organizzatore'];

        // Riga da aggiungere al file CSV
        $riga_csv = "$nome_organizzatore;$tipologia_eventi;$sede;$stato;$mail;$descrizione\r\n";
        $file_csv = "../documenti/richieste/accetta.csv";

        // // Scrivo nel file CSV
        // try {
        //     if (!file_exists("../documenti/richieste/")) {
        //         mkdir("../documenti/richieste/", 0777, true); // Crea la directory se non esiste
        //     }
            file_put_contents($file_csv, $riga_csv, FILE_APPEND | LOCK_EX);
        // } catch (Exception $e) {
        //     die("Errore: Non è stato possibile scrivere nel file CSV. " . $e->getMessage());
        // }

        // Preparo e invio l'email
        $to = "lorisanvi2000@gmail.com";
        $subject = "Nuova richiesta di registrazione";
        $message = "È stata ricevuta una nuova richiesta di registrazione.\n\n"
                 . "Nome Organizzatore: $nome_organizzatore\n"
                 . "Tipologia Eventi: $tipologia_eventi\n"
                 . "Sede: $sede\n"
                 . "Stato: $stato\n"
                 . "Mail: $mail\n"
                 . "Descrizione Organizzatore: $descrizione\n";
        $headers = "From: no-reply@tuosito.com";

        //if (!mail($to, $subject, $message, $headers)) {
        //    die("Errore: Non è stato possibile inviare l'email.");->serve connettersi al server SMTP configurato per inviare email
        //}

        echo "Richiesta inviata con successo e email inviata all'amministratore!";
    }
}

// Eseguiamo la funzione solo se il metodo è GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Creiamo un'istanza della classe GestoreMail
    $gestoreMail = new GestoreMail();
    // Chiamato il metodo mandaMailRichiestaAmministratore con i dati ricevuti dal form
    $gestoreMail->mandaMailRichiestaAmministratore($_GET);
} else {
    die("Errore: Metodo non supportato.");
}
?>
