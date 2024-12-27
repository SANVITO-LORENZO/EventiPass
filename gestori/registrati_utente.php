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
    if (isset($_GET["messaggio"])) echo $_GET["messaggio"];
    ?>

    <form action="gestoreRegistrazione.php" method="GET">
        Nome: <input type="text" name="nome" required>
        <br>
        Password: <input type="password" name="password" required>
        <br>
        Ruolo:
        <select name="ruolo" required>
            <option value="utente">utente</option>
        </select>
        <br>
        <button>REGISTRATI</button>
    </form>

    <form action="index.php">
        <button>Torna al Login</button>
    </form>
</body>
</html>
