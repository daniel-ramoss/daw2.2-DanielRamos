<?php
require_once "variosTrabajoFinal.php";

$conexionBD = obtenerPdoConexionBD();

$id =(int)$_REQUEST["id"];

$sql = "DELETE FROM examen WHERE id=?";

$sentencia = $conexionBD->prepare($sql);

$sqlConExito = $sentencia->execute([$id]);

$correctaEjecucion = ($sqlConExito && $sentencia->rowCount() == 1);

$noExiste = ($sqlConExito && $sentencia->rowCount() == 0)

?>

<html>

<head>
    <meta charset="UTF-8">
</head>



<body>

<?php if ($correctaEjecucion) { ?>

    <h1>Eliminación completada</h1>
    <p>Se ha eliminado correctamente el examen.</p>

<?php } else if ($noExiste) { ?>

    <h1>Eliminación no realizada</h1>
    <p>No existe el examen que se intentó eliminar...</p>

<?php } else { ?>

    <h1>Error en la eliminación</h1>
    <p>No se ha podido eliminar el examen.</p>

<?php } ?>

<a href="examen-listado.php">Volver al listado de exámenes.</a>

</body>

</html>
