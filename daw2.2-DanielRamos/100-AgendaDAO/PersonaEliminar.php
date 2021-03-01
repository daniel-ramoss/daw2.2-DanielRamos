<?php

require_once "_com/Dao.php";

$conexionBD = obtenerPdoConexionBD();

$id =(int)$_REQUEST["id"];

$sql = "DELETE FROM persona WHERE id=?";

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
    <p>Se ha eliminado correctamente la persona.</p>

<?php } else if ($noExiste) { ?>

    <h1>Eliminación no realizada</h1>
    <p>No existe la persona que se intentó eliminar (puede que la hayan eliminado previamente, o se haya manipulado el id).</p>

<?php } else { ?>

    <h1>Error en la eliminación</h1>
    <p>No se ha podido eliminar la persona.</p>

<?php } ?>

<a href="PersonaListado.php">Volver al listado de personas.</a>

</body>

</html>