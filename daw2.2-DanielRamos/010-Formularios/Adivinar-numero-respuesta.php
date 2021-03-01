<?php
    $oculto = (int) $_REQUEST["oculto"];
    if (isset($_REQUEST["intento"])){
        $intento = (int) $_REQUEST["intento"];
        $contador = (int) $_REQUEST["contador"] + 1;

    } else{
        $intento = null; //Primera vez que se inicia
        $contador = 0;
    }

?>
<html>
<head>
    <title>Adivinar número resultado</title>
    <meta charset="UTF-8">
    <h1>ADIVINA EL NÚMERO</h1>
</head>
<body>
    <?php
        if($intento == null){
         //Intento 0
        } elseif ($intento > $oculto){
            echo"<p>El número oculto es <b>MENOR</b> al introducido ($intento).</p>";
        } elseif ($intento < $oculto){
            echo"<p>El número oculto es <b>MAYOR</b> al introducido ($intento).</p>";
        } else{ ?>
            <h1>¡Acertaste!</h1>
            <p>Número de intentos: <?=$contador?></p>
    <?php
        }
    ?>

    <?php
        if($intento != $oculto){ ?>
            <p>Llevas <?=$contador?> intentos.</p>
            <form>
                <input type="hidden" name="oculto" value="<?=$oculto?>" />
                <input type="hidden" name="contador" value="<?=$contador?>" />

                <input type="number" name="intento" />
                <input type="submit" name="intentar" value="Intentar" />
            </form>
    <?php
        }
    ?>

</body>
</html>
