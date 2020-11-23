<?php
require_once "variosTrabajoFinal.php";

$conexionBD = obtenerPdoConexionBD();

// Se recogen los datos del formulario con la request.
$id = (int)$_REQUEST["id"];
$nombre = $_REQUEST["nombre"];

$nuevoTipoExamen = ($id == -1);

if ($nuevoTipoExamen) { // Se quiere crear un tipo nuevo, usamos un INSERT
    $sql = "INSERT INTO tipoexamen (nombre) VALUES (?)";
    $parametros = [$nombre];
} else { // Aquí se quiere modificar por lo que usamos un UPDATE
    $sql = "UPDATE tipoexamen SET nombre=? WHERE id=?";
    $parametros = [$nombre, $id];
}

$sentencia = $conexionBD->prepare($sql);

$sqlConExito = $sentencia->execute($parametros);


$unaFilaAfectada = ($sentencia->rowCount() == 1);
$ningunaFilaAfectada = ($sentencia->rowCount() == 0);

// Está bien si no ocurren errores y se ha visto afectada una fila.
$correcto = ($sqlConExito && $unaFilaAfectada);

// Si los datos no se habían modificado, también está correcto.
$datosNoModificados = ($sqlConExito && $ningunaFilaAfectada);

// INTERFAZ
// $id
// $nombre
?>

<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php
if ($correcto || $datosNoModificados) { ?>
    <!-- Si la ejecución de la sentencia se produjo correctamente o no se cambió nada se hace lo siguiente -->
    <?php if ($id == -1) { ?>
        <h1>Inserción completada</h1>
        <p>Se ha insertado correctamente (<?=$nombre?>) </p>
    <?php } else { ?>
        <h1>Guardado completado</h1>
        <p>Se han guardado correctamente los datos de <?=$nombre?>.</p>

        <?php if ($datosNoModificados) { ?>
            <p>No se ha modificado nada...</p>
        <?php } ?>
    <?php }
    ?>

    <?php
} else { ?>
    <h1>Error en la modificación.</h1>
    <p>No se han podido guardar los datos del tipo de examen.</p>
 <?php } ?>

<a href="tipoExamen-listado.php">Volver al listado de tipos.</a>


</body>
</html>


