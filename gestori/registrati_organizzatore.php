<?php
require_once ('gestoreCSV.php');
require_once(__DIR__."/../verificalogin.php");
verifica_sessione();
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

    <?php
    //SE C'E' UN MESSAGGIO QUESTO VIENE VISUALIZZATO
    if (isset($_GET["messaggio"])) echo $_GET["messaggio"];
    ?>

    <!-- MANDA A GESTOREORGANIZZATORE TUTTE LE INFORMAZIONI UTILI PER LA RICHIESTA DELL'ORGANIZZATORE -->
    <form action="gestoreOrganizzatore.php" method="POST">

        <label>Nome:</label>
        <br>
        <input type="text" name="nome-organizzatore" required>
        <br><br>
        <label>Pass:</label>
        <br>
        <input type="text" name="pass-organizzatore" required>
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
        <button >INVIA RICHIESTA</button>
    </form>
    
</body>
</html>