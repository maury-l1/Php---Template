
<?php
/*veureTotesLesNoticies.php: mostra totes les notícies endreçades per data (de més nova a més antiga).*/

    // Em connecto a la base de dades
    $db = new SQLite3('diariLocal.db');

    // Llegeixo les dades
    $resultats = $db->query("SELECT COUNT(*) AS numFebrer FROM noticies WHERE not_data LIKE '%-02-%' ORDER BY not_data DESC;");
    $fila = $resultats->fetchArray(SQLITE3_ASSOC);

    //Mostro dades
    echo "<h1>Número de seccions de febrer</h1>";
    echo "N. notícies febrer: ".$fila['numFebrer'];

    // Tanco la connexió
    $db->close();
?>