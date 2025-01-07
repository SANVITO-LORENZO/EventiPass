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
    <link rel="stylesheet" href="grafica/organizzatore.css">
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
                <td><label >Nome dell'evento:</label></td>
                <td><input type="text" id="nome" name="nome" required></td>
            </tr>
            <tr>
                <td><label >Tipologia dell'evento:</label></td>
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
                <td><label >Data di inizio:</label></td>
                <td><input type="datetime-local" id="data_inizio" name="data_inizio" required></td>
            </tr>
            <tr>
                <td><label >Data di fine:</label></td>
                <td><input type="datetime-local" id="data_fine" name="data_fine" required></td>
            </tr>
            <tr>
                <td><label >Luogo:</label></td>
                <td>
                    <select  name="luogo" required>
                        <?php
                            $gestore=new GestoreCSV();
                            $tipologie=$gestore->ottieni_da_file(__DIR__."/documenti/citta.csv");
                            foreach($tipologie as $tipologia){
                                echo "<option value='$tipologia'>$tipologia</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label >Descrizione:</label></td>
                <td><textarea id="descrizione" name="descrizione" required></textarea></td>
            </tr>
            <tr>
                <td><label>Prezzo:</label></td>
                <td><input type="number" id="prezzo" name="prezzo" min="0" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <button type="submit">CREA EVENTO</button>
                </td>
            </tr>
        </table>
    </form>
    <h3>tabella dei propri eventi</h3>
    <table border="1">
            <tr>
                <th>Nome</th>
                <th>Luogo</th>
                <th>Prezzo</th>
                <th>Modifica</th>
            </tr>
            <?php
                try {
                    $eventi = $gestore->ottieni_da_file(__DIR__ . "/documenti/eventi.csv");
                    foreach ($eventi as $evento) {
                        $dati = explode(";", $evento);
                        if ($dati[1] == $_SESSION["username"]) {
                            echo "<tr>";
                            echo "<td>" . $dati[2] . "</td>";
                            echo "<td>" . $dati[6] . "</td>";
                            echo "<td>" . $dati[8] . "€</td>";
                            echo "<td>";
                            echo "<form action='gestori/gestioni_eventi.php' method='POST'>";
                            echo "<input type='hidden' name='evento_id' value='" . $dati[0] . "'>";
                            echo "<button type='submit'>Modifica</button>";
                            echo "</form>";
                            echo "</td>";                            echo "</tr>";
                        }
                    }
                } catch (Exception $e) {
                    echo "<tr><td colspan='8'>Errore: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                }
            ?>
        </tbody>
    </table>

    
    <!-- BOTTONE CHE GESTISCE IL LOGOUT -->
    <form action="gestori/gestoreLogout.php" method="POST">
        <button>LOGOUT</button>
    </form>
</body>
</html>
