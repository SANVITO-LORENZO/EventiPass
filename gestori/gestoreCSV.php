<?php
require_once("classi\users.php");

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

    public function getOpzioni($filename, $ruolo) {
        $opzioni = [];
        if (file_exists($filename)) {
            $contenuto = file_get_contents($filename);
            $righe = explode("\r\n", $contenuto);

            foreach ($righe as $riga) {
                if (!empty($riga)) {
                    $campi = explode(";", $riga);
                    if (count($campi) == 2) {

                        if ($campi[1] == $ruolo || $campi[1] == 'b') {
                            $opzioni[] = $campi[0];
                        }
                    }
                }
            }
        } else {
            throw new Exception("File non trovato: " . $filename);
        }
        return $opzioni;
    }


    public function aggiornaRuolo($filename, $username, $nuovo_ruolo) {
        $contenuto = file_get_contents($filename);
        $righe = explode("\r\n", $contenuto);
        $nuovo_contenuto = "";

        foreach ($righe as $riga) {
            if (!empty($riga)) {
                $campi = explode(";", $riga);
                if ($campi[0] == $username) {
                    $campi[1] = $nuovo_ruolo;
                }
                $nuovo_contenuto .= implode(";", $campi) . "\r\n";
            }
        }
        file_put_contents($filename, $nuovo_contenuto);
    }
}
?>
