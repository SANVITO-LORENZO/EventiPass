<?php
require_once("evento.php");
require_once(__DIR__."/../gestori/gestoreCSV.php");

class Eventi {
    //gestione di tutti gli eventi
    private $vettore_eventi;
    private $gestoreCSV;

    public function __construct() {
        $this->vettore_eventi = [];

        //leggo tutte le righe dal file,ottengo un vettore di stringhe
        try {
            $this->gestoreCSV = new GestoreCSV();
            $file_eventi =  $this->gestoreCSV->ottieni_da_file(__DIR__."/../documenti/eventi.csv");
            foreach ($file_eventi as $riga) {
                $campi = explode(";", $riga);//per ogni riga lo parso con l'explode
                $evento = new Evento($campi[0], $campi[1], $campi[2], $campi[3], $campi[4], $campi[5], $campi[6], $campi[7],$campi[8]);
                $this->vettore_eventi[] = $evento;//passo i campi al costruttore che poi accodo nell'array
            } 
        } catch (Exception $e) {
            printf("Errore durante la lettura dei file: ".$e->getMessage());
        }
    }

    //ridà l'evento con quel nome
    public function ottieniPerNome($nome) {
        foreach ($this->vettore_eventi as $evento) {
            if ($evento->getNome() == $nome) {
                return $evento;
            }
        }
        return NULL;
    }

    //ridà l'evento con quell'id (chiave primaria)
    public function ottieniPerId($id) {
        foreach ($this->vettore_eventi as $evento) {
            if ($evento->getId() == $id) {
                return $evento;
            }
        }
        return NULL;
    }

    //la filtra(tasto search)
    public function ottieniEventiPerTipologia($tipologia) {
        $eventi_tipologia = [];
        foreach ($this->vettore_eventi as $evento) {
            if ($evento->getTipologia() == $tipologia || $tipologia == "") {//se seleziono una tipologia mi dà tutti gli eventi di quella tipologia
                $eventi_tipologia[] = $evento;
            }
        }
        return $eventi_tipologia;
    }

    //salva gli eventi sul file
    public function salva() {
        $righe = [];
        foreach ($this->vettore_eventi as $evento) {
            $righe[] = $evento->toCsv();
        }
        $this->gestoreCSV->salva_su_file(__DIR__."/../documenti/eventi.csv", $righe);
    }


    //prende l'ultimo id usato,ci somma 1 ottenendo il nuovo id,crea l'evento con quell'id e parametri
    public function creaEvento($creatore, $nome, $tipologia, $data_inizio, $data_fine, $luogo, $descrizione, $prezzo) {
        
        $id=$this->vettore_eventi[count($this->vettore_eventi)-1]->getId()+1;
        $evento = new Evento($id,$creatore, $nome, $tipologia, $data_inizio, $data_fine, $luogo, $descrizione, $prezzo);
        $this->vettore_eventi[] = $evento;//lo accodo
        $righe = [];
        foreach ($this->vettore_eventi as $tmp) {
            $righe[] = $tmp->toCsv();
        }
        $this->gestoreCSV->salva_su_file(__DIR__."/../documenti/eventi.csv", $righe);
    }
}
?>
