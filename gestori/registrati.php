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
    if (isset($_POST["messaggio"])) echo $_POST["messaggio"];
    ?>

    <form action="gestori\gestoreRegistrazione.php" method="POST">
        Nome: <input type="text" name="nome" required>
        <br>
        Password: <input type="password" name="password" required>
        <br>
        Ruolo:
        <select name="ruolo" required>
            <option value="studente">Studente</option>
        </select>
        <br>
        <button>REGISTRATI</button>
    </form>

    <form action="index.php">
        <button>Torna al Login</button>
    </form>
</body>
</html>
