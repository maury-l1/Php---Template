<?php
$titular = $_GET['titular'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerca Notícies Parcials</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen flex flex-col items-center p-8">
    <h1 class="text-4xl font-bold mb-8 text-teal-400">Buscar notícies parcials</h1>

    <form action="cercaNotParcial.php" method="get" class="bg-gray-800 p-6 rounded-2xl shadow-xl w-full max-w-xl mb-10">
        <label for="titular" class="block text-lg mb-2 text-gray-300">Titular parcial:</label>
        <input type="text" name="titular" id="titular" value="<?= htmlspecialchars($titular) ?>" 
               class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-teal-500 text-gray-100 mb-4" 
               placeholder="Introduce parte del titular...">
        <button type="submit" 
                class="w-full bg-teal-500 hover:bg-teal-600 transition-colors text-white p-3 rounded-xl font-semibold shadow">
            Buscar
        </button>
    </form>

    <?php
    if (!empty(trim($titular))) {
        $db = new SQLite3('diariLocal.db');
        $stmt = $db->prepare('SELECT * FROM noticies WHERE not_titular LIKE :titular');
        $stmt->bindValue(':titular', '%' . $titular . '%', SQLITE3_TEXT);
        $results = $stmt->execute();

        echo "<h2 class='text-2xl font-semibold text-teal-300 mb-4'>Resultados para <span class='italic text-teal-400'>$titular</span>:</h2>";

        $found = false;
        echo "<div class='space-y-4 w-full max-w-2xl'>";
        while ($fila = $results->fetchArray(SQLITE3_ASSOC)) {
            $found = true;
            echo "<div class='bg-gray-800 p-4 rounded-xl shadow border border-gray-700'>";
            echo "<p class='text-gray-400 text-sm mb-2'>Fecha: <span class='text-gray-200 font-semibold'>{$fila['not_data']}</span></p>";
            echo "<p class='text-xl font-bold text-gray-100 mb-2'>{$fila['not_titular']}</p>";
            echo "<p class='text-gray-300 mb-2'>{$fila['not_cos']}</p>";
            echo "<p class='text-teal-400 text-sm'>Sección: <span class='text-teal-300'>{$fila['not_seccio']}</span></p>";
            echo "</div>";
        }
        echo "</div>";

        if (!$found) {
            echo "<p class='text-gray-400 mt-4'>No se encontraron noticias para <b>$titular</b>.</p>";
        }
    } else {
        echo "<p class='text-gray-400 mb-4'>Introduce un titular parcial para realizar la búsqueda.</p>";
    }
    ?>

    <a href="cercaNotParcial.php" 
       class="mt-10 inline-block bg-gray-700 hover:bg-gray-600 transition-colors text-gray-100 px-6 py-3 rounded-xl shadow-lg">
       Volver
    </a>
</body>
</html>
