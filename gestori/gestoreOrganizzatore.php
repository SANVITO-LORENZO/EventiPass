<?php

require("gestoreCSV.php");

    $gestore=new GestoreCSV();

        $dati = [
            'nome-organizzatore' => $_GET['nome-organizzatore'],
            'pass-organizzatore' => $_GET['pass-organizzatore'],
            'sede' => $_GET['sede'],
            'stato' => $_GET['stato'],
            'mail' => $_GET['mail'],
        ];
         
        $nome_organizzatore = $dati['nome-organizzatore'];
        $pass_organizzatore = $dati['pass-organizzatore'];
        $sede = $dati['sede'];
        $stato = $dati['stato'];
        $mail = $dati['mail'];
        
        // Riga da aggiungere al file CSV
        $riga_csv = "$nome_organizzatore;$pass_organizzatore;$sede;$stato;$mail\r\n";
        $file_csv = "../documenti/loginOrganizzatori.csv";

       
        $contenuto = file_get_contents($file_csv);
        $righe = explode("\r\n", $contenuto);

        foreach ($righe as $riga) {
            if (!empty($riga)) {
                $campi = explode(";", $riga);
                if ($campi[0] === $nome_organizzatore) {
                    header("Location:registrati_organizzatore.php?messaggio=Nome utente già esistente!");
                    exit();
                }
            }
        }


        $gestore->salva_su_file_append($file_csv, $riga_csv);

        header("location: ../index.php?messaggio=organizzatore registrato! ");
     
?>
