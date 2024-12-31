<?php
if (!isset($_GET['nome']) || !isset($_GET['password']) || !isset($_GET['ruolo'])) {
    header("Location: registrati.php?messaggio=Errore nei dati inviati.");
    exit();
}

$nome = $_GET['nome'];
$password = $_GET['password'];
$ruolo = $_GET['ruolo'];

if (empty($nome) || empty($password) || empty($ruolo)) {
    header("Location: ..\registrati.php?messaggio=Compila tutti i campi.");
    exit();
}


$users_file = "..\documenti\login.csv";
$contenuto = file_get_contents($users_file);
$righe = explode("\r\n", $contenuto);

foreach ($righe as $riga) {
    if (!empty($riga)) {
        $campi = explode(";", $riga);
        if ($campi[0] === $nome) {
            header("Location: ..\registrati.php?messaggio=Nome utente già esistente.");
            exit();
        }
    }
}


$nuovo_utente = "$nome;$password;$ruolo";
if ($contenuto) {
    file_put_contents($users_file, "\r\n" . $nuovo_utente, FILE_APPEND);
} else {
    file_put_contents($users_file, $nuovo_utente, FILE_APPEND);
}
header("Location: ..\index.php?messaggio=Registrazione completata con successo.");
exit();
?>
