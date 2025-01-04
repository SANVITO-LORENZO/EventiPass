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

    public function campiNonEsistenti($nome,$cf,$mail,$numero){
        $utenti=$this->ottieni_da_file(__DIR__."/../documenti/users/utenti.csv");
        $organizzatori=$this->ottieni_da_file(__DIR__."/../documenti/users/organizzatori.csv");
        $admin=$this->ottieni_da_file(__DIR__."/../documenti/users/admin.csv");
        foreach($utenti as $u){
            $campi=explode(";",$u);
            if($campi[0]==$nome || $campi[3]==$cf || $campi[4]==$mail||$campi[6]==$numero){
                return false;
            }
        }
        foreach($organizzatori as $u){
            $campi=explode(";",$u);
            if($campi[0]==$nome ||  $campi[4]==$mail){
                return false;
            }
        }
        foreach($admin as $u){
            $campi=explode(";",$u);
            if($campi[0]==$nome ){
                return false;
            }
        }
        return true;
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
