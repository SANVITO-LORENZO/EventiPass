<?php
require_once("..\classi\users.php");

class GestoreCSV {
    public function generaUtenti($filename) {
        $vett_utenti = [];
        if (file_exists($filename)) {
            $contenuto = file_get_contents($filename);
            $righe = explode("\r\n", $contenuto);

            foreach ($righe as $riga) {
                if (!empty($riga)) {
                    $campi = explode(";", $riga);
                    if (count($campi) == 3) {
                        $vett_utenti[] = new Utente($campi[0], $campi[1], $campi[2]);
                    }
                }
            }
        } else {
            throw new Exception("File non trovato: " . $filename);
        }
        return $vett_utenti;
    }

    public function ottieni_da_file($filename) {
        $vett_informazioni = [];
        if (file_exists($filename)) {
            $contenuto = file_get_contents($filename);
            $vett_informazioni = explode("\r\n", $contenuto);
        } else {
            throw new Exception("File non trovato: " . $filename);
        }
        return $vett_informazioni;
    }
}
?>
