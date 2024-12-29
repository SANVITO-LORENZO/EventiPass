<?php
class Evento{
    private $creatore;
    private $nome;
    private $tipologia;
    private $data_inizio;
    private $data_fine;
    private $luogo;
    private $descrizione;
    private $prezzo;
    

    public function __construct($creatore, $nome, $tipologia, $data_inizio, $data_fine, $luogo, $descrizione, $prezzo) {
        $this->creatore = $creatore;
        $this->nome = $nome;
        $this->tipologia = $tipologia;
        $this->data_inizio = $data_inizio;
        $this->data_fine = $data_fine;
        $this->luogo = $luogo;
        $this->descrizione = $descrizione;
        $this->prezzo = $prezzo;
    }
    public function getCreatore() {
        return $this->creatore;
    }
    public function getNome() {
        return $this->nome;
    }
    public function getTipologia() { 
        return $this->tipologia;
    }
    public function getDataInizio() {
        return $this->data_inizio;
    }
    public function getDataFine() {
        return $this->data_fine;
    }
    public function getLuogo() {
        return $this->luogo;
    }
    public function getDescrizione() {
        return $this->descrizione;
    }
    public function getPrezzo() {
        return $this->prezzo;
    }
    public function toCsv() {
    return $this->creatore.";".$this->nome.";".$this->tipologia.";".$this->data_inizio.";".$this->data_fine.";".$this->luogo.";".$this->descrizione.";".$this->prezzo;
    }
}
?>