<?php
class Evento{
    private $id;
    private $creatore;
    private $nome;
    private $tipologia;
    private $data_inizio;
    private $data_fine;
    private $luogo;
    private $descrizione;
    private $prezzo;
    

    public function __construct($id,$creatore, $nome, $tipologia, $data_inizio, $data_fine, $luogo, $descrizione, $prezzo) {
        $this->id = $id;
        $this->creatore = $creatore;
        $this->nome = $nome;
        $this->tipologia = $tipologia;
        $this->data_inizio = new DateTime($data_inizio);
        $this->data_fine = new DateTime($data_fine);
        $this->luogo = $luogo;
        $this->descrizione = $descrizione;
        $this->prezzo = $prezzo;
    }
    public function getId() {
        return $this->id;
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
    return $this->id.";".$this->creatore.";".$this->nome.";".$this->tipologia.";".$this->data_inizio->format('Y-m-d H:i:s').";".$this->data_fine->format('Y-m-d H:i:s').";".$this->luogo.";".$this->descrizione.";".$this->prezzo;
    }
    public function render($mostraPrenota){
        $render="";
        $render.= "<div>";
        $render.= "Creatore: ".$this->creatore."<br>";
        $render.= "Nome: ".$this->nome."<br>";
        $render.= "Tipologia: ".$this->tipologia."<br>";
        $render.= "DataInizio: ".$this->data_inizio->format('Y-m-d H:i:s')."<br>";
        $render.= "Data fine: ".$this->data_fine->format('Y-m-d H:i:s')."<br>";
        $render.= "Luogo: ".$this->luogo."<br>";
        $render.= "Descrizione: ".$this->descrizione."<br>";
        $render.= "Prezzo: ".$this->prezzo."<br>";
        if($mostraPrenota){
            $render.= "<a href='gestori/prenota.php?IdEvento=".$this->id."'>prenotati</a>";
        }
        $render.= "<hr>";
        $render.= "</div>";
        return $render;
    }
}
?>