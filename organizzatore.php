<?php
//SE LA SESSIONE NON ESISTE SI CREA
if (!isset($_SESSION)) session_start();

//CONTROLLO SE LA VARIABILE DI SESSIONE AUTENTICATO E' ESISTENTE
if (!isset($_SESSION["autenticato"])) {
    header("location: index.php?messaggio=errore");
    exit;
}

//CONTROLLO SE AUTENTICATO NON CORRISPONDE AD O MANDO A PAGINA INDEX
if ($_SESSION["autenticato"] != "O") {
    header("location: index.php?messaggio=errore");
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creazione Evento</title>
</head>
<body>
    <h1>PAGINA ORGANIZZATORE</h1>
    <h2>
        <?php
        //MOSTRA IL NOME DI CHI E' LOGGATO
        echo 'Benvenuto ' . $_SESSION["username"];
        //SE C'E' UN MESSAGGIO QUESTO VIENE VISUALIZZATO
        if (isset($_GET["messaggio"])) echo $_GET["messaggio"];
        ?>
    </h2>

    <!-- FORM PER CREARE NUOVO EVENTO -->
    <h3>Creazione Nuovo Evento</h3>
    <form action="gestori/creazione.php" method="POST">
        Nome dell'evento:
        <input type="text" id="nome" name="nome" required><br><br>

        Tipologia dell'evento:<br>
        <input type="text" id="tipologia" name="tipologia" required><br><br>

        Data di inizio:<br>
        <input type="datetime-local" id="data_inizio" name="data_inizio" required><br><br>

        Data di fine:<br>
        <input type="datetime-local" id="data_fine" name="data_fine" required><br><br>

        Luogo:<br>
        <input type="text" id="luogo" name="luogo" required><br><br>

        Descrizione:<br>
        <textarea id="descrizione" name="descrizione" required></textarea><br><br>

        Prezzo:<br>
        <input type="number" id="prezzo" name="prezzo" step="0.01" required><br><br>

        <button type="submit">CREA EVENTO</button>
    </form>

        <!-- BOTTONE CHE GESTISCE IL LOGOUT -->
        <form action="gestori/gestoreLogout.php" method="POST">
        <button>LOGOUT</button>
    </form>
</body>
</html>
