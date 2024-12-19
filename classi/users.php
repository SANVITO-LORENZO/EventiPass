<?php
require_once("user.php");
require_once("gestori\gestoreCSV.php");

class Utenti {
    private $vett_utenti;
    private $gestoreCSV;

    public function __construct() {
        $this->vett_utenti = [];
        $this->gestoreCSV = new GestoreCSV();

        try {
            $this->vett_utenti = $this->gestoreCSV->generaUtenti("documenti\login.csv");
        } catch (Exception $e) {
        }
    }

    public function isPresente($nome, $password): string {
        foreach ($this->vett_utenti as $utente) {
            if ($utente->getNome() == $nome && $utente->getPassword() == $password) {
                return $utente->getRuolo();
            }
        }
        return "niente";
    }

}
?>
