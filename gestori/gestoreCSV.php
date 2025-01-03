<?php
require_once(__DIR__."/..\classi\user.php");

class GestoreCSV {

    //FUNZIONA CHE PARTENDO DA UN FILE GENERA UN VETTORE SEPARANDO PER I SIMBOLI "\r\n"
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

    //SALVA SUL FILE NON IN APPEND
    public function salva_su_file($filename, $righe): void {
        $contenuto = implode("\r\n", $righe);
        file_put_contents($filename, $contenuto);
    }

    //SALVA SUL FILE IN APPEND
    public function salva_su_file_append($filename, $righe): void {
       
        file_put_contents($filename, $righe,FILE_APPEND);
    }
}
?>
