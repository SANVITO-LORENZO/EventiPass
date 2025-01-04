<?php
require_once("prenotazione.php");
require_once(__DIR__."/../gestori/gestoreCSV.php");

class Prenotazioni {
    private $vettore_prenotazioni;
    private $gestoreCSV;

    public function __construct() {
        $this->vettore_prenotazioni = [];
        $this->gestoreCSV = new GestoreCSV();

        try {
            $file_eventi =  $this->gestoreCSV->ottieni_da_file(__DIR__."/../documenti/prenotazioni.csv");
            foreach ($file_eventi as $riga) {
                $campi = explode(";", $riga);
                $prenotazione = new Prenotazione($campi[0], $campi[1]);
                $this->vettore_prenotazioni[] = $prenotazione;
            } 
        } catch (Exception $e) {
            printf("Errore durante la lettura dei file: ".$e->getMessage());
        }
    }

    public function verificaEsistenza($nome,$id_evento) {
        foreach ($this->vettore_prenotazioni as $prenotazione) {
            if ($prenotazione->getNome() == $nome && $prenotazione->getIdEvento() == $id_evento) {
                return true;
            }
        }
        return false;
    }


    public function salva() {
        $righe = [];
        foreach ($this->vettore_prenotazioni as $prenotazione) {
            $righe[] = $prenotazione->toCsv();
        }
        $gestoreCSV = new GestoreCSV();
        $gestoreCSV->salva_su_file(__DIR__."/../documenti/prenotazioni.csv", $righe);
    }

    public function creaPrenotazione($creatore, $idEvento) {
        $prenotazione = new Prenotazione($creatore, $idEvento);
        $this->vettore_prenotazioni[] = $prenotazione;
        if(count($this->vettore_prenotazioni)==0)
            $this->gestoreCSV->salva_su_file_append(__DIR__."/../documenti/prenotazioni.csv",$prenotazione->toCsv());
        else
            $this->gestoreCSV->salva_su_file_append(__DIR__."/../documenti/prenotazioni.csv","\r\n".$prenotazione->toCsv());
    
    }
}
?>
