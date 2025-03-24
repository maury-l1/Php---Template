
<?php
/*veureTotesLesNoticies.php: mostra totes les notícies endreçades per data (de més nova a més antiga).*/

    // Em connecto a la base de dades
    $db = new SQLite3('diariLocal.db');

    // Llegeixo les dades
    $resultats = $db->query("SELECT * FROM noticies WHERE not_data LIKE '%-02-%' ORDER BY not_data DESC;");

// SELECT * FROM noticies WHERE SUBSTRING(not_data, 6, 2) = '02' ORDER BY not_data DESC;

    //Mostro dades
    echo "<h1>Notícies Febrer:</h1>";
    while($fila = $resultats->fetchArray(SQLITE3_ASSOC)) {
        echo "<hr>";
        echo "[$fila[not_seccio]] - $fila[not_data] <br>";
        echo "<b>'".$fila['not_titular']."</b>'->".$fila['not_cos']."<br>";
    }
    echo "<hr>";
    // Tanco la connexió
    $db->close();
?>