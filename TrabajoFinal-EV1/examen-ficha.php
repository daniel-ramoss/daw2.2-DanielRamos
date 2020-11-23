<?php
require_once "variosTrabajoFinal.php";

$conexion = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];

$nuevoExamen = ($id == -1);

if ($nuevoExamen) {
    $nombreExamen = "<introduzca  el nombre del examen>";
    $fechaExamen = "<introduzca la fecha del examen con este formato (yyyy-mm-dd)>";
    $aprobado = false;
    $idTipoExamen = "<introduzca el id del tipo de examen>";

} else {
    $sqlExamenes = "SELECT * FROM examen WHERE id=?";

    $select = $conexion->prepare($sqlExamenes);
    $select->execute([$id]);
    $resultSetExamen = $select->fetchAll();

    $nombreExamen = $resultSetExamen[0]["nombre"];
    $fechaExamen = $resultSetExamen[0]["fecha"];
    $aprobado = ($resultSetExamen[0]["aprobado"] == 1);
    $idTipoExamen = $resultSetExamen[0]["tipoExamenId"];
}

// preparamos un resulSet de los tipos de examen
$sqlTipoExamen = "SELECT * FROM tipoexamen ORDER BY nombre";

$select = $conexion->prepare($sqlTipoExamen);
$select->execute([]); // Array vacío porque la consulta preparada no requiere parámetros.
$resultSetTipoExamen = $select->fetchAll();

?>



<html>

<head>
    <meta charset="UTF-8">
</head>

<body>

<?php if ($nuevoExamen) { ?>
    <h1>Nuevo Examen</h1>
<?php } else { ?>
    <h1>Datos del Examen</h1>
<?php } ?>

<form method='post' action='examen-guardar.php'>
    <input type='hidden' name='id' value='<?=$id?>' />
    <ul>
        <li>
            <label for='nombre'> <strong>Nombre: </strong> </label>
            <input type='text' name='nombre' value='<?=$nombreExamen?>' />
        </li>
        <li>
            <label for='fecha'> <strong> Fecha: </strong> </label>
            <input type='date' name='fecha' value='<?=$fechaExamen?>' />
        </li>
        <li>
            <!-- Aquí se hace el select del nombre del tipo de examen  -->
            <label for='tipoExamenId'> <strong>Tipo Examen: </strong> </label>
            <select name='tipoExamenId'>
                <?php
                foreach ($resultSetTipoExamen as $fila) {
                    $tipoExamenId = (int)$fila["id"];
                    $nombreTipoExamen = $fila["nombre"];

                    if ($tipoExamenId == $idTipoExamen){
                        $seleccion = "selected = 'true' ";
                    } else {
                        $seleccion = "";
                    }
                    echo "<option value='$tipoExamenId' $seleccion> $nombreTipoExamen </option>";
                }
                ?>
            </select>
        </li>
        <li>
            <label for='aprobado'> <strong> Aprobado: </strong></label>
            <input type='checkbox' name='aprobado' <?=$aprobado ? "checked" : "" ?> >
            <span> (si ya se ha hecho este examen y se ha aprobado marcar la casilla) </span>
            <!-- Marcar en caso de que se haya realizado y aprobado ese examen-->
        </li>
    </ul>

    <?php if ($nuevoExamen) { ?>
        <input type='submit' name='crear-examen' value='Crear Examen' />
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
    <?php } ?>
</form>
<br>

<?php if (!$nuevoExamen){ ?>
    <a href="examen-eliminar.php?id=<?=$id?>">Eliminar Examen</a>
<?php } ?>

<br><br>
<a href="examen-listado.php">Volver al listado de Exámenes.</a>

</body>

</html>

