<?php
require_once "variosTrabajoFinal.php";

$conexionBD = obtenerPdoConexionBD();

// Se recoge el parámetro "id" de la request.
$id = (int)$_REQUEST["id"];

$sql = "DELETE FROM tipoexamen WHERE id=?";

$sentencia = $conexionBD->prepare($sql);
// Se devuelve true o false dependiendo de si la ejecución de la sentencia ha ido bien o mal.
$sqlExito = $sentencia->execute([$id]);

// Está  correcto de forma normal si NO ocurren errores y ha afectado a UNA fila.
$correctoNormal = ($sqlExito && $sentencia->rowCount() == 1);

// Si hay cero filas afectadas (No existía la fila en la BD)
$noExisteFila = ($sqlExito && $sentencia->rowCount() == 0);

// INTERFAZ:
// $correctoNormal
// $noExisteFila
?>

<html>
<head>
    <meta charset='UTF-8'>
</head>
<body>

<?php if ($correctoNormal) { ?>

    <h1>Se Completó La Eliminación</h1>
    <p>Se ha eliminado correctamente el tipo de exámen.</p>

<?php } else if ($noExisteFila) { ?>

    <h1>Eliminación no realizada</h1>
    <p>No existe el tipo de exámen que se pretende eliminar...</p>

<?php } else { ?>

    <h1>Error en la eliminación</h1>
    <p>No se ha podido eliminar el tipo de examen...</p>

<?php } ?>

<a href='tipoExamen-listado.php'>Volver al listado de Tipos de Exámenes.</a>

</body>
</html>

