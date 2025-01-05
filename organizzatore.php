<?php
require_once("gestori/gestoreCSV.php");
require_once("verificalogin.php");

//SE LA SESSIONE NON ESISTE SI CREA E VERIFICA LOGIN CON RUOLO CORRETTO
verifica_login("O");

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creazione Evento</title>
</head>
<body>
    <h1>PAGINA ORGANIZZATORE</h1>
    <h2>
        <?php
        //MOSTRA IL NOME DI CHI E' LOGGATO
        echo 'Benvenuto ' . $_SESSION["username"];
        ?>
    </h2>

    <?php
        //SE C'E' UN MESSAGGIO QUESTO VIENE VISUALIZZATO
        if (isset($_GET["messaggio"])) echo $_GET["messaggio"];
    ?>

    <!-- FORM PER CREARE NUOVO EVENTO -->
    <h3>Creazione Nuovo Evento</h3>
    <form action="gestori/creazione.php" method="POST">
        <table>
            <tr>
                <td><label for="nome">Nome dell'evento:</label></td>
                <td><input type="text" id="nome" name="nome" required></td>
            </tr>
            <tr>
                <td><label for="tipologia">Tipologia dell'evento:</label></td>
                <td><select  id="tipologia" name="tipologia" required>
                    <?php
                        $gestore=new GestoreCSV();
                        $tipologie=$gestore->ottieni_da_file(__DIR__."/documenti/tipologie.csv");
                        foreach($tipologie as $tipologia){
                            echo "<option value='$tipologia'>$tipologia</option>";
                        }
                    ?>
                </select></td>
            </tr>
            <tr>
                <td><label for="data_inizio">Data di inizio:</label></td>
                <td><input type="datetime-local" id="data_inizio" name="data_inizio" required></td>
            </tr>
            <tr>
                <td><label for="data_fine">Data di fine:</label></td>
                <td><input type="datetime-local" id="data_fine" name="data_fine" required></td>
            </tr>
            <tr>
                <td><label for="luogo">Luogo:</label></td>
                <td><input type="text" id="luogo" name="luogo" required></td>
            </tr>
            <tr>
                <td><label for="descrizione">Descrizione:</label></td>
                <td><textarea id="descrizione" name="descrizione" required></textarea></td>
            </tr>
            <tr>
                <td><label for="prezzo">Prezzo:</label></td>
                <td><input type="number" id="prezzo" name="prezzo" step="0.01" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <button type="submit">CREA EVENTO</button>
                </td>
            </tr>
        </table>
    </form>
    
    <!-- BOTTONE CHE GESTISCE IL LOGOUT -->
    <form action="gestori/gestoreLogout.php" method="POST">
        <button>LOGOUT</button>
    </form>
</body>
</html>
