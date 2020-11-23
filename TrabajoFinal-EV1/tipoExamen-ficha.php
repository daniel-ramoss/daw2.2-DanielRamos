<?php
require_once "variosTrabajoFinal.php";

$conexionBD = obtenerPdoConexionBD();

// Se recoge el parámetro "id" de la request.
$id = (int)$_REQUEST["id"];

// Si id es -1 se quiere crear un nuevo tipo de examen  (será true).
// Si id NO es -1 se quiere ver un tipo de examen existente (será false).
$nuevoTipoExamen = ($id == -1);

if ($nuevoTipoExamen) {
    $tipoExamenNombre = "<introduzca el nombre del tipo>";
} else {
    $sql = "SELECT nombre FROM tipoexamen WHERE id=?";

    $select = $conexionBD->prepare($sql);
    $select->execute([$id]);
    $rs = $select->fetchAll();

    // Así accedemos a los datos de la primera fila que haya venido.
    $tipoExamenNombre = $rs[0]["nombre"];
}
// INTERFAZ
// $id
// $tipoExamenNombre

?>

<html>
<head>
    <meta charset="UTF-8">
</head>
<body>

<?php if ($nuevoTipoExamen) { ?>
    <h1>Nuevo tipo de Examen</h1>
<?php } else { ?>
    <h1>Tipo de Examen</h1>
<?php } ?>

<form method='post' action='tipoExamen-guardar.php'>
    <input type='hidden' name='id' value='<?=$id?>'>
    <ul>
        <li>
            <strong>Nombre: </strong>
            <input type='text' name='nombre' value='<?=$tipoExamenNombre?>'>
        </li>
    </ul>
    <?php if ($nuevoTipoExamen) { ?>
        <input type='submit' name='crear' value='Crear tipo de examen' />
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
    <?php } ?>
</form>

<br><br>

<a href='tipoExamen-eliminar.php?id=<?=$id ?>'>Eliminar tipo de examen</a>

<br><br>

<a href="tipoExamen-listado.php">Volver al listado tipos de examen.</a>


</body>
</html>


