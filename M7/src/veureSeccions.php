
<?php
/*veureTotesLesNoticies.php: mostra totes les notícies endreçades per data (de més nova a més antiga).*/

    // Em connecto a la base de dades
    $db = new SQLite3('diariLocal.db');

    // Llegeixo les dades
    $resultats = $db->query("SELECT DISTINCT not_seccio FROM noticies ORDER BY not_seccio;");
    $fila = $resultats->fetchArray(SQLITE3_ASSOC);



    //Mostro dades
    echo "<h1>Seccions</h1>";
    while($fila = $resultats->fetchArray(SQLITE3_ASSOC)) {
        echo "<li>".$fila['not_seccio']."</li>";
    }

    // Tanco la connexió
    $db->close();
?>