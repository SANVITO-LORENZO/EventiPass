<?php
class Utente{
    private $nome;
    private $password;
    private $ruolo;

    public function __construct($nome, $password, $ruolo) {
        $this->nome = $nome;
        $this->password = $password;
        $this->ruolo = $ruolo;
    }

    public function getNome() {
        return $this->nome;
    }
    public function getPassword() { 
        return $this->password;
    }
    public function getRuolo() {
        return $this->ruolo;
    }

}
?>