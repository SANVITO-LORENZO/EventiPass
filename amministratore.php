<?php
require_once("gestori/gestoreCSV.php");

//SE LA SESSIONE NON ESISTE SI CREA
if(!isset($_SESSION)) session_start();

//CONTROLLO SE LA VARIABILE DI SESSIONE AUTENTICATO E' ESISTENTE
if(!isset($_SESSION["autenticato"])){
    header("location: index.php?messaggio=errore");
    exit;
}

//A -->  AMMINISTRATORE
//O -->  ORGANIZZATORE
//U -->  UTENTE
//CONTROLLO SE AUTENTICATO NON CORRISPONDE AD A MANDO A PAGINA INDEX
if($_SESSION["autenticato"]!="A"){
    header("location: index.php?messaggio=errore");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="grafica/amministratore.css">
    <title>Document</title>
</head>
<body>
    <h1> PAGINA AMMINISTRATORE</h1>    
    <h2>
        <?php
        //MOSTRA IL NOME DI CHI E LOGGATO
        echo 'benvenuto  '.$_SESSION["username"];
        //SE C'E' UN MESSAGGIO QUESTO VIENE VISUALIZZATO
        if (isset($_GET["messaggio"])) echo $_GET["messaggio"];
        ?>
    </h2>
    <h2>Richieste</h2>
    <table>
        <tr>
            <th>Nome</th>
            <th>Sede</th>
            <th>Stato</th>
            <th>Mail</th>
            <th>Accetta</th>
            <th>Rifiuta</th>
        </tr>
        <?php
        try {
            $file = 'documenti/richieste.csv';
            $gestore = new GestoreCSV();
            $dati = $gestore->ottieni_da_file($file);

            //CREAZIONE DELLE RIGHE DELLA TABELLA NELLE ULTIME DUE COLONNE DUE BOTTONI UNO PER ACCETTARE UNO PER RIFIUTARE
            foreach ($dati as $linea) {
                if (!empty($linea)) {
                    $campi = explode(";", $linea);
                    if (count($campi) >= 5) {

                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($campi[0]) . "</td>";
                        echo "<td>" . htmlspecialchars($campi[2]) . "</td>";
                        echo "<td>" . htmlspecialchars($campi[3]) . "</td>";
                        echo "<td>" . htmlspecialchars($campi[4]) . "</td>";

                        //CREAZIONE DEI BOTTONI CON DEI VALORI NASCOSTI CHE SI PASSERANNO TRAMITE METODO GET
                        echo "<td><form action='gestori/accetta_rifiuta_richiesta.php' method='POST'>
                                    <input type='hidden' name='name' value='" . htmlspecialchars($campi[0]) . "'>
                                    <input type='hidden' name='azione' value='accetta'>
                                    <button type='submit'>Accetta</button>
                                  </form></td>";
                        echo "<td><form action='gestori/accetta_rifiuta_richiesta.php' method='POST'>
                                    <input type='hidden' name='name' value='" . htmlspecialchars($campi[0]) . "'>
                                    <input type='hidden' name='azione' value='rifiuta'>
                                    <button type='submit'>Rifiuta</button>
                                  </form></td>";
                        echo "</tr>";
                    }
                }
            }
        } catch (Exception $e) {
            echo "<tr><td colspan='6'>Errore: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
        }
        ?>
    </table>
    
    <!-- BOTTONE CHE GESTISCE IL LOGOUT -->
    <form action="gestori\gestoreLogout.php">
        <button>LOGOUT</button>
    </form>
</body>
</html>
