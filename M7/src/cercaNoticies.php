<?php
      if(isset ($_GET['titular'])){
        $titular = $_GET['titular'];
      }

    $db = new SQLite3('diariLocal.db');
    $stmt = $db->prepare('SELECT * FROM noticies WHERE not_titular = :titular');
    $stmt->bindValue(':titular', $titular, SQLITE3_TEXT);
    $results = $stmt->execute();

    echo "<h1>Noticias sobre $titular:</h1>";
    while($fila = $results->fetchArray(SQLITE3_ASSOC)) {
        echo "<hr>";
        echo "$fila[not_data] <br>";
        echo "<b>'".$fila['not_cos']."</b>'->".$fila['not_seccio']."<br>";
    }
    echo "<hr>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="cercaNoticies.php" method="get">
        <label for="titular">
            <input type="text" name="titular">
        </label>
    </form>
    <button action = "cercaNoticies.php">Volver</button>
</body>
</html>