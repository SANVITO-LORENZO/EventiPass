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

    //DATO UN FILE GENERO UN VETTORE DI UTENTI
    public function generaUtenti($filename) {
        //VETTORE VUOTO
        $vett_utenti = [];
        //CONTROLLO SE FILE ESISTE
        if (file_exists($filename)) {
            //SEPARA TUTTE LE FìRIGHE DEL FILE IGNORANDO LE RIGHE VUOTE E I CARATTERI \N E \R (CARATTERI DI FINE RIGA)
            $righe = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            //PER OGNI RIGA
            foreach ($righe as $riga) {
                //CONTROLLO SE E' VUOTA
                if (!empty($riga)) {
                    //DIVIDO PER IL ;
                    $campi = explode(";", $riga);
                    //CONTROLLO CHE IL NUMERO DEI CAMPI SIA UGUALE A 3
                    if (count($campi) == 3) {
                        //AGGIUNGO UN NUOVO UTENTE
                        $vett_utenti[] = new Utente($campi[0], $campi[1], $campi[2]);
                    }
                }
            }
        } else {
            throw new Exception("File non trovato: " . $filename);
        }
        return $vett_utenti;
    }

    //DATO UN NOME E LA PASSWORD CONTROLLO SE PRESENTE E NEL CASO RESTITUISCO IL RUOLO ALTRIMENTI NULLA
    public function isPresente($nome, $password): string {
        foreach ($this->vett_utenti as $utente) {
            if ($utente->getNome() === $nome && $utente->getPassword() === $password) {
                return $utente->getRuolo();
            }
        }
        return "niente";
    }
}
