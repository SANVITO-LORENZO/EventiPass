<?php
require_once("prenotazione.php");
require_once(__DIR__."/../gestori/gestoreCSV.php");

class Prenotazioni {

    //corrispettivo di events
    //gestione di tutte le prenotazioni
    private $vettore_prenotazioni;
    private $gestoreCSV;

    public function __construct() {
        $this->vettore_prenotazioni = [];
        $this->gestoreCSV = new GestoreCSV();

        //ottengo tutte le righe
        try {
            $file_eventi =  $this->gestoreCSV->ottieni_da_file(__DIR__."/../documenti/prenotazioni.csv");
            foreach ($file_eventi as $riga) {
                $campi = explode(";", $riga);//esplodo ogni riga
                $prenotazione = new Prenotazione($campi[0], $campi[1]);//creo la prenotazione
                $this->vettore_prenotazioni[] = $prenotazione;//accodo
            } 
        } catch (Exception $e) {
            printf("Errore durante la lettura dei file: ".$e->getMessage());
        }
    }

    //controllo se la prenotazione esiste già
    public function verificaEsistenza($nome,$id_evento) {
        foreach ($this->vettore_prenotazioni as $prenotazione) {
            if ($prenotazione->getNome() == $nome && $prenotazione->getIdEvento() == $id_evento) {
                return true;
            }
        }
        return false;
    }

    //dato il nome della persona ,mi restituisce l'array di prenotazioni che ha fatto la persona
    public function ottieniByNome($nome) {
        $prenotazioni = [];
        foreach ($this->vettore_prenotazioni as $prenotazione) {
            if ($prenotazione->getNome() == $nome) {
                $prenotazioni[] = $prenotazione;
            }
        }
        return $prenotazioni;
    }

    //salva  i dati 
    public function salva() {
        $righe = [];
        foreach ($this->vettore_prenotazioni as $prenotazione) {
            $righe[] = $prenotazione->toCsv();
        }
        $gestoreCSV = new GestoreCSV();
        $gestoreCSV->salva_su_file(__DIR__."/../documenti/prenotazioni.csv", $righe);
    }

    //crea la prenotazione
    public function creaPrenotazione($creatore, $idEvento) {
        $prenotazione = new Prenotazione($creatore, $idEvento);
        $this->vettore_prenotazioni[] = $prenotazione;//accodo all'array
        if(count($this->vettore_prenotazioni)==0)//salvo la prenotazione nel file
            $this->gestoreCSV->salva_su_file_append(__DIR__."/../documenti/prenotazioni.csv",$prenotazione->toCsv());
        else
            $this->gestoreCSV->salva_su_file_append(__DIR__."/../documenti/prenotazioni.csv","\r\n".$prenotazione->toCsv());
    
    }

}
?>
