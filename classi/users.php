<?php
require_once("user.php");
require_once("..\gestori\gestoreCSV.php");

class Utenti {
    private $vett_utenti;
    private $gestoreCSV;

    public function __construct() {
        $this->vett_utenti = [];
        $this->gestoreCSV = new GestoreCSV();

        try {
            $this->vett_utenti = $this->generaUtenti("..\documenti\login.csv");
        } catch (Exception $e) {
        }
    }

    public function generaUtenti($filename) {
        $vett_utenti = [];
        if (file_exists($filename)) {
            $contenuto = file_get_contents($filename);
            $righe = explode("\r\n", $contenuto);

            foreach ($righe as $riga) {
                if (!empty($riga)) {
                    $campi = explode(";", $riga);
                    if (count($campi) == 3) {
                        $vett_utenti[] = new Utente($campi[0], $campi[1], $campi[2]);
                    }
                }
            }
        } else {
            throw new Exception("File non trovato: " . $filename);
        }
        return $vett_utenti;
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
