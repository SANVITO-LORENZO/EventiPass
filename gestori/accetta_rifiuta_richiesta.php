<?php
require_once("gestoreCSV.php");
require_once(__DIR__."/../verificalogin.php");

verifica_sessione();

$nome = $_POST['name'];
$azione = $_POST['azione'];

//CONTROLLO SE SETTATE
if (!isset($_POST['name']) || !isset($_POST['azione'])) {
    header("Location: ../index.php?messaggio=Errore con comando amministratore");
    exit();
}

//CONTROLLO CHE NON SIANO VUOTE
if (empty($nome) || empty($azione)) {
    header("Location: ../index.php?messaggio=Errore con comando amministratore");
    exit();
}

//PATH DEI FILE
$fileRichieste = '../documenti/richieste.csv';
$fileOrganizzatori = '../documenti/users/organizzatori.csv';
$fileLogin = '../documenti/login.csv';

try {
    $gestore = new GestoreCSV();

    //OTTIENE LE RIGHE DAL FILE
    $righeRichieste = $gestore->ottieni_da_file($fileRichieste);

    $righeAggiornate = [];
    $tmp = null;
    $password = null;

    //PER OGNI RIGA
    foreach ($righeRichieste as $riga) {
        //CONTROLLO SE NON E' VUOTA
        if (!empty($riga)) {
            //DIVIDO LA RIGA PER ;
            $campi = explode(";", $riga);

            //SE I CAMPI SONO 5 O PIU' E IL PRIMO CAMPO CORRISPONDE AL NOME
            if (count($campi) >= 5 && $campi[0] == $nome) {
                //TROVATA LA RIGA CORRISPONDENTE
                $tmp = $riga;
                //LA PASSWORD CORRISPONDE AL SECONDO CAMPO
                $password = $campi[1]; 
            } else {
                //ALTRIMENTI AGGIUNGO A VETT LA RIGA
                $righeAggiornate[] = $riga;
            }
        }
    }

    //SE VARIABILE NON E' NULLA
    if ($tmp) {
        //SE SI VUOLE ACCETTARE
        if ($azione == 'accetta') {
            //AGGIUNGO AL FILE ORGANIZZATORI LA RIGA CON UN NUOVO CARATTERE DI FINE LINEA
            file_put_contents($fileOrganizzatori, $tmp . "\n", FILE_APPEND);

            //CREO STRINGA DA AGGIUNGERE AL FILE DI LOGIN
            $nuovaRigaLogin = "$nome;$password;O\n";

            //PRENDO INFORMAZIONI DA FILE DI LOGIN
            $contenutoLogin = file($fileLogin, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            //AGGIUNGO LA NUOVA RIGA
            $contenutoLogin[] = $nuovaRigaLogin;
            //RISCRIVO IL FILE DI LOGIN GARANTENDO UNA RIGA PER OGNI VOCE
            file_put_contents($fileLogin, implode("\n", $contenutoLogin) . "\n");
        }
    }

    //AGGIORNO IL FILE DELLE RICHIESTE
    file_put_contents($fileRichieste, implode("\n", $righeAggiornate));

    //TORNO ALLA PAGINA DELL'AMMINISTRATORE
    header("Location: ../index.php");
    exit;

} catch (Exception $e) {
    die("Errore: " . htmlspecialchars($e->getMessage()));
}
?>
