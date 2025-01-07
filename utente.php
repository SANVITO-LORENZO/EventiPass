<?php
require_once("classi/events.php");
require_once("gestori/gestoreCSV.php");
require_once("verificalogin.php");

//SE LA SESSIONE NON ESISTE SI CREA E VERIFICA LOGIN CON RUOLO CORRETTO
verifica_login("U");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="grafica/utente.css">
</head>
<body>
    <h1>PAGINA UTENTE</h1>
    <h2>
        <?php
        //MOSTRA IL NOME DI CHI E LOGGATO
        echo 'benvenuto  '.$_SESSION["username"];
        ?>
    </h2>
    <?php
        //SE C'E' UN MESSAGGIO QUESTO VIENE VISUALIZZATO
        if (isset($_GET["messaggio"])) echo "<h1>". $_GET["messaggio"]."</h1>";
    ?>
    <form action="utente.php">
    <select name="tipologia">
        <option value="">Tutte</option>
        <?php
        $gestore=new GestoreCSV();
        $tipologie=$gestore->ottieni_da_file(__DIR__."/documenti/tipologie.csv");
        foreach($tipologie as $tipologia){
            echo "<option value='$tipologia'>$tipologia</option>";
        }
       ?>
            
    </select>

        <input type="submit"value="Search"/>
        
       </form>
    <?php
        //VISUALIZZA EVENTI IN BASE AL TIPOLOGIA (NULL PER TUTTI)
        $categoria="";
        if(isset($_GET["tipologia"]))
            $categoria=$_GET["tipologia"];

        $file_eventi=new Eventi();
        foreach($file_eventi->ottieniEventiPerTipologia($categoria) as $evento){
            echo $evento->render(true);
        }
    ?>

    <form action="gestori\gestoreInfoUtente.php">
        <button>Area personale</button>
    </form>
    
    <!-- BOTTONE CHE GESTISCE IL LOGOUT -->
    <form action="gestori\gestoreLogout.php">
        <button>LOGOUT</button>
    </form>
</body>
</html>