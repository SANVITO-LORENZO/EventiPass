<?php
require_once("gestori/gestoreCSV.php");

if(!isset($_SESSION)) session_start();

if(!isset($_SESSION["autenticato"])){
    header("location: index.php?messaggio=errore");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            width: 0%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            padding: 5px 10px;
            margin: 2px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Amministratore</h1>

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

            foreach ($dati as $linea) {
                if (!empty($linea)) {
                    $campi = explode(";", $linea);
                    if (count($campi) >= 5) {
                        list($nome, $password, $sede, $stato, $mail) = $campi;
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($nome) . "</td>";
                        echo "<td>" . htmlspecialchars($sede) . "</td>";
                        echo "<td>" . htmlspecialchars($stato) . "</td>";
                        echo "<td>" . htmlspecialchars($mail) . "</td>";
                        echo "<td><form action='gestori/accetta_rifiuta_richiesta.php' method='GET'>
                                    <input type='hidden' name='nome' value='" . htmlspecialchars($nome) . "'>
                                    <input type='hidden' name='azione' value='accetta'>
                                    <button type='submit'>Accetta</button>
                                  </form></td>";
                        echo "<td><form action='gestori/accetta_rifiuta_richiesta.php' method='GET'>
                                    <input type='hidden' name='nome' value='" . htmlspecialchars($nome) . "'>
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

    <form action="gestori\gestoreLogout.php">
        <button>LOGOUT</button>
    </form>
</body>
</html>
