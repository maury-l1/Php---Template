<?php
$gameOver = false;
$jugadas = [];
if (isset($_GET['jugadas'])) {
    $jugadas = explode(",", $_GET['jugadas']);
}
    if(isset ($_GET['number'])){
        $numUsuario = $_GET['number'];
        echo "Se ha enviado el numero " . $numUsuario . "<br><br/>";
        $numSecreto = $_GET['numSecreto'];
        $numIntentos = $_GET['numIntentos'];
        $jugadas[] = $numUsuario;
        $info = $_GET['info'];
        
        if ($numUsuario == $numSecreto){
            $info = "Has acertado!!<br>";
            echo '<a href="numerMagic.php">Jugar de nuevo</a>';
            $gameOver = true;
        }        
        if ($numUsuario < $numSecreto){
            $info = "El numero secreto es mayor";
            $numIntentos--;
        }
        if ($numUsuario > $numSecreto){
            $info = "El numero secreto es menor";
            $numIntentos--;
        }
        
    }else{
        $numSecreto = rand(0, 10);
        $numIntentos = 3;
        $info = "Aqui se muestra la info";
        echo "Primera vez que se ejecuta la pagina, numSecreto ->" . $numSecreto;
    }
    if ($numIntentos <= 0 && !$gameOver){
        $info = "Has agotado tus intentos. El número secreto era: $numSecreto <br>";
        echo '<a href="numerMagic.php">Jugar de nuevo</a>';
        $gameOver = true;
    }
    if (count($jugadas) > 0) {
        echo "<p><strong>Números que has jugado:</strong> " . implode(", ", $jugadas) . "</p>";
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Numero Magico</h1>    
    </header>
    <div class = "infoCont">
        <h3 name = "info" value = ""><?php echo $info; ?></h3>

    </div>
    <div>
    <?php if (!$gameOver): ?>
<form method="get" action="numerMagic.php">
    <label for="number">Introduce el numero
        <input type="text" name="number">
    </label>

    <input type="hidden" name="info" value="<?php echo $info; ?>"/>
    <input type="hidden" name="jugadas" value="<?php echo implode(",", $jugadas); ?>"/>
    <input type="hidden" name="numSecreto" value="<?php echo $numSecreto; ?>"/>
    <input type="hidden" name="numIntentos" value="<?php echo $numIntentos; ?>"/>
    <input type="submit" value="Enviar">
</form>
<?php endif; ?>
    </div>
</body>
</html>