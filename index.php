<?php
if (!isset($_SESSION)) session_start();
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
    if (isset($_SESSION["autenticato"])) {
        header("Location: gestori/indirizzamento.php");  
        exit;
    }

    if (isset($_GET["messaggio"])) echo $_GET["messaggio"];
    ?>

    <form action="gestori/gestoreLogin.php" method="GET">
        Nome: <input type="text" name="nome" required>
        <br>
        Password: <input type="password" name="password" required>
        <br>
        <button>EFFETTUA IL LOGIN</button>
    </form>

    <form action="gestori/registrati_organizzatore.php">
        <button>REGISTRA ORGANIZZATORE</button>
    </form>
    <form action="gestori/registrati_utente.php">
        <button>REGISTRA UTENTE</button>
    </form>
</body>
</html>
