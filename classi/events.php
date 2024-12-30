<?php
require_once("evento.php");
require_once(__DIR__."/../gestori/gestoreCSV.php");

class Events {
    private $vett_events;
    private $gestoreCSV;

    public function __construct() {
        $this->vett_events = [];

        try {
            $gCSV=new GestoreCSV();
            $file_eventi =$gCSV->ottieni_da_file(__DIR__."/../documenti/eventi.csv");
            foreach ($file_eventi as $riga) {
                $campi=explode(";",$riga);
                $event = new Evento($campi[0], $campi[1], $campi[2], $campi[3], $campi[4], $campi[5], $campi[6], $campi[7]);
                $this->vett_events[] = $event;
            }
        } catch (Exception $e) {
            printf("Errore durante la lettura dei file: ".$e->getMessage());
        }
    }

    public function getByNome($nome) {
        foreach ($this->vett_events as $event) {
            if ($event->getNome() == $nome) {
                return $event;
            }
        }
        return NULL;
    }

    public function getEventsByTipologia($tipologia) {
        $events_tipologia = [];
        foreach ($this->vett_events as $event) {
            if ($event->getTipologia() == $tipologia || $tipologia=="") {
                $events_tipologia[] = $event;
            }
        }
        return $events_tipologia;
    }

    public function salva(){
        $righe = [];
        foreach ($this->vett_events as $event) {
            $righe[] = $event->toCsv();
        }
        $gCSV=new GestoreCSV();
        $gCSV->salva_su_file("../documenti/eventi.csv", $righe);
    }
}
?>
