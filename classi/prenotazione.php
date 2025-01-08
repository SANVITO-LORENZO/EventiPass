<?php
class Prenotazione{

    //creo la singola prenotazione
    private $nome;
    private $id_evento;

    public function __construct($nome, $nome_evento) {
        $this->nome = $nome;
        $this->id_evento = $nome_evento;
    }

    public function getNome() {
        return $this->nome;
    }
    public function getIdEvento() { 
        return $this->id_evento;
    }
    public function toCsv() {
        return $this->nome.";".$this->id_evento;
    }

}
?>