<?php
require_once "varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];
$nombre = $_REQUEST["nombre"];
$telefono = $_REQUEST["telefono"];
$categoriaId =(int)$_REQUEST["categoria_id"];

$nuevaPersona = ($id == -1);

if ($nuevaPersona) {
    $sql = "INSERT INTO persona (nombre, telefono, categoria_id) VALUES (?, ?, ?)";
    $parametros = [$nombre, $telefono, $categoriaId];
} else {
    $sql = "UPDATE persona SET nombre=?, telefono=?, categoria_id=? WHERE id=?";
    $parametros = [$nombre, $telefono, $categoriaId, $id];
}

$sentencia = $conexion->prepare($sql);

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
        <p>Se han insertado correctamente las nuevas entradas de <?=$nombre?>, <?=$telefono?> y <?=$categoriaId?>.</p>
    <?php } else { ?>
        <h1>Guardado completado</h1>
        <p>Se han guardado correctamente los datos de <?=$nombre?>, <?=$telefono?> y <?=$categoriaId?>.</p>

        <?php if ($datosNoModificados) { ?>
            <p>No se ha modificado nada.</p>
        <?php } ?>
<?php  }  ?>

<?php } else { ?>

        <h1>Error en la modificación.</h1>
        <p>No se han podido guardar los datos de la persona.</p>

<?php } ?>

<a href="persona-listado.php">Volver a la lista de Personas.</a>

</body>

</html>
