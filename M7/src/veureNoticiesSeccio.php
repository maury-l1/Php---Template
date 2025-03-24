<?php
    //Recupero la secció triada del get
    $nomSeccio = $_GET['nomSeccio'];

    // Em connecto a la base de dades
    $db = new SQLite3('diariLocal.db');

    // Llegeixo les dades
    $resultats = $db->query("SELECT * FROM noticies WHERE not_seccio = '$nomSeccio' ORDER BY not_data DESC;");


    // Mostro dades
    echo "<h1>Notícies $nomSeccio:</h1>";
    while($fila = $resultats->fetchArray(SQLITE3_ASSOC)) {
        echo "<hr>";
        echo "$fila[not_data] <br>";
        echo "<b>'".$fila['not_titular']."</b>'->".$fila['not_cos']."<br>";
    }
    echo "<hr>";

?>
