<?php
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
</head>
<body>
    <h1>UTENTE BASE</h1>



    <form action="gestori\gestoreLogout.php">
        <button>LOGOUT</button>
    </form>
</body>
</html>