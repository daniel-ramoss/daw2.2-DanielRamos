<?php
require_once "variosTrabajoFinal.php";

$conexionBD = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];
$nombre = $_REQUEST["nombre"];
$fecha = $_REQUEST["fecha"];
$aprobado = isset($_REQUEST["aprobado"]);
$idTipoExamen =(int)$_REQUEST["tipoExamenId"];

$nuevoExamen = ($id == -1);

if ($nuevoExamen) {
    $sql = "INSERT INTO examen (nombre, fecha, aprobado, tipoExamenId) VALUES (?, ?, ?, ?)";
    $parametros = [$nombre, $fecha, $aprobado?1:0, $idTipoExamen];
} else {
    $sql = "UPDATE examen SET nombre=?, fecha=?, aprobado=?, tipoExamenId=? WHERE id=?";
    $parametros = [$nombre, $fecha, $aprobado, $idTipoExamen, $id];
}

$sentencia = $conexionBD->prepare($sql);

$sqlConExito = $sentencia->execute($parametros);


$unaFilaAfectada = ($sentencia->rowCount() == 1);
$ningunaFilaAfectada = ($sentencia->rowCount() == 0);

$correctaEjecucion = ($sqlConExito && $unaFilaAfectada);

$datosNoModificados = ($sqlConExito && $ningunaFilaAfectada);
?>

<html>

<head>
    <meta charset="UTF-8">
</head>



<body>

<?php

if ($correctaEjecucion || $datosNoModificados) { ?>
    <?php if ($id == -1) { ?>
        <h1>Inserción completada</h1>
        <p>Se han insertado correctamente las nuevas entradas de <?=$nombre?>, <?=$fecha?>, <?=$aprobado?>, <?=$idTipoExamen?>.</p>
    <?php } else { ?>
        <h1>Guardado completado</h1>
        <p>Se han guardado correctamente los datos de <?=$nombre?>, <?=$fecha?>, <?=$aprobado?>, <?=$idTipoExamen?>.</p>

        <?php if ($datosNoModificados) { ?>
            <p>No se ha modificado nada.</p>
        <?php } ?>
    <?php  }  ?>

<?php } else { ?>

    <h1>Error en la modificación.</h1>
    <p>No se han podido guardar los datos del examen...</p>

<?php } ?>

<a href="examen-listado.php">Volver al listado de Exámenes.</a>

</body>

</html>

