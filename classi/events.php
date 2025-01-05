<?php
require_once("evento.php");
require_once(__DIR__."/../gestori/gestoreCSV.php");

class Eventi {
    private $vettore_eventi;
    private $gestoreCSV;

    public function __construct() {
        $this->vettore_eventi = [];

        try {
            $this->gestoreCSV = new GestoreCSV();
            $file_eventi =  $this->gestoreCSV->ottieni_da_file(__DIR__."/../documenti/eventi.csv");
            foreach ($file_eventi as $riga) {
                $campi = explode(";", $riga);
                $evento = new Evento($campi[0], $campi[1], $campi[2], $campi[3], $campi[4], $campi[5], $campi[6], $campi[7],$campi[8]);
                $this->vettore_eventi[] = $evento;
            } 
        } catch (Exception $e) {
            printf("Errore durante la lettura dei file: ".$e->getMessage());
        }
    }

    public function ottieniPerNome($nome) {
        foreach ($this->vettore_eventi as $evento) {
            if ($evento->getNome() == $nome) {
                return $evento;
            }
        }
        return NULL;
    }

    public function ottieniPerId($id) {
        foreach ($this->vettore_eventi as $evento) {
            if ($evento->getId() == $id) {
                return $evento;
            }
        }
        return NULL;
    }
    public function ottieniEventiPerTipologia($tipologia) {
        $eventi_tipologia = [];
        foreach ($this->vettore_eventi as $evento) {
            if ($evento->getTipologia() == $tipologia || $tipologia == "") {
                $eventi_tipologia[] = $evento;
            }
        }
        return $eventi_tipologia;
    }

    public function salva() {
        $righe = [];
        foreach ($this->vettore_eventi as $evento) {
            $righe[] = $evento->toCsv();
        }
        $this->gestoreCSV->salva_su_file(__DIR__."/../documenti/eventi.csv", $righe);
    }

    public function creaEvento($creatore, $nome, $tipologia, $data_inizio, $data_fine, $luogo, $descrizione, $prezzo) {
        
        $id=$this->vettore_eventi[count($this->vettore_eventi)-1]->getId()+1;
        $evento = new Evento($id,$creatore, $nome, $tipologia, $data_inizio, $data_fine, $luogo, $descrizione, $prezzo);
        $this->vettore_eventi[] = $evento;
        $righe = [];
        foreach ($this->vettore_eventi as $tmp) {
            $righe[] = $tmp->toCsv();
        }
        $this->gestoreCSV->salva_su_file(__DIR__."/../documenti/eventi.csv", $righe);
    }
}
?>
