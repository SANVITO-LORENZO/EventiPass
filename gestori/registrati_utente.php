<?php
//SE LA SESSIONE NON ESISTE SI CREA
if(!isset($_SESSION))session_start();
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
