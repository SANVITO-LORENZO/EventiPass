<?php
require_once(__DIR__."/verificalogin.php");
verifica_sessione();
redirect("sei gia loggato");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina di Login</title>
</head>
<body>
    <h1>PAGINA DI LOGIN</h1>

    <?php
    //SE GIA AUTENTICATO VA A INDIRIZZAMENTO
    if (isset($_SESSION["autenticato"])) {
        header("Location: gestori/indirizzamento.php");  
        exit;
    }

    //SE C'E' UN MESSAGGIO QUESTO VIENE VISUALIZZATO
    if (isset($_GET["messaggio"])) echo $_GET["messaggio"];
    ?>

    <!-- MANDA A GESTORE LOGIN NOME E PASSWORD INSERITI -->
    <form action="gestori/gestoreLogin.php" method="POST">
        Nome: <input type="text" name="nome" required>
        <br>
        Password: <input type="password" name="password" required>
        <br>
        <button>EFFETTUA IL LOGIN</button>
    </form>

    <!-- MANDA A PAGINA PER LA REGISTRAZIONE DELL'ORGANIZZATORE -->
    <form action="gestori/registrati_organizzatore.php">
        <button>REGISTRA ORGANIZZATORE</button>
    </form>

    <!-- MANDA A PAGINA PER LA REGISTRAZIONE DELL'UTENTE -->
    <form action="gestori/registrati_utente.php">
        <button>REGISTRA UTENTE</button>
    </form>
</body>
</html>
