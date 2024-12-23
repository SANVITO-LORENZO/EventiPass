<?php
require_once ('gestoreCSV.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>REGISTRAZIONE ORGANIZZATORE</h1>

    <form action="/submit-form" method="GET">

        <label>Nome Organizzatore:</label>
        <br>
        <input type="text" name="nome-organizzatore" required>
        <br><br>
        <label>Tipologia di Eventi:</label>
        <br>
        <select name="tipologia-eventi" required>
        <?php
            $gestoreCSV = new GestoreCSV();
            $tipologie = $gestoreCSV->ottieni_da_file("../documenti/tipologie.csv");
            foreach ($tipologie as $tipologia) {
                if (!empty($tipologia)) { 
                    echo "<option value=\"$tipologia\">$tipologia</option>";
                }
            }

        ?>
        </select>
        <br><br>
        <label for="sede">Sede:</label>
        <br>
        <input type="text" name="sede" required>
        <br><br>
        <label for="stato">Stato:</label><br>
        <input type="text" name="stato" required>
        <br><br>
        <label for="mail">Mail:</label><br>
        <input type="email" name="mail" required>
        <br><br>
        <label >Descrizione :</label>
        <br>
        <textarea name="descrizione-organizzatore" rows="5" cols="30" required></textarea>
        <br><br>
        <button type="submit">INVIA RICHIESTA</button>
    </form>
    
</body>
</html>