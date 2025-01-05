<?php
require_once(__DIR__."/../verificalogin.php");
require_once(__DIR__."/gestoreCSV.php");
verifica_sessione();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione Nuovo Utente</title>
</head>
<body>
    <h1>REGISTRAZIONE NUOVO UTENTE</h1>

    <?php
        //SE C'E' UN MESSAGGIO QUESTO VIENE VISUALIZZATO
    if (isset($_GET["messaggio"])) echo $_GET["messaggio"];
    ?>

    <form action="gestoreRegistrazione.php" method="POST">
        Nome: <input type="text" name="nome" required>
        <br>
        COGNOME: <input type="text" name="cognome" required>
        <br>
        ETA: <input type="number" name="eta" required>
        <br>
        CF: <input type="text" name="cf" required>
        <br>
        MAIL: <input type="email" name="mail" required>
        <br>
        PREFISSI: 
        <select  name="prefissi" required>
            <?php
                $gestore=new GestoreCSV();
                $prefissi=$gestore->ottieni_da_file(__DIR__."/../documenti/prefissi.csv");
                foreach($prefissi as $prefisso){
                    echo "<option value='$prefisso'>$prefisso</option>";
                }
            ?>
        </select>
        <br>
        NUMERO: <input type="text" name="numero" required>
        <br>
        RESIDENZA: <input type="text" name="residenza" required>
        <br>
        CARTA: <input type="text" name="carta" required>
        <br>
        Password: <input type="password" name="password" required>
        <br>
        Ruolo:
        <select name="ruolo" required>
            <option value="U" selected>utente</option>
        </select>
        <br>
        <button>REGISTRATI</button>
    </form>

    <form action="../index.php">
        <button>Torna al Login</button>
    </form>
</body>
</html>
