<?php
require_once(__DIR__."/../classi/events.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $e=new Events();
  
        $event=$e->getByNome($_GET["NomeEvento"]);
        echo $event->toCsv();
    ?>
</body>
</html>