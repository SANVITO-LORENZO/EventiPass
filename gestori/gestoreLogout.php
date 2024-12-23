<?php
    session_start();
    session_destroy();
    header("Location: ..\index.php?messaggio=logout effettuato correttamente");
    exit;
?>