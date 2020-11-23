<?php
require_once "variosTrabajoFinal.php";

$conexionBD = obtenerPdoConexionBD();

$sql = "SELECT * FROM tipoexamen ORDER BY nombre";

$select = $conexionBD->prepare($sql);
$select->execute([]); // Array vacío porque la consulta preparada no requiere parámetros.
$resultSet = $select->fetchAll();

// INTERFAZ
// $resultSet
?>

<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<h1>Listado de Tipos de Exámenes.</h1>
<table border='1'>
    <tr>
        <th>Nombre</th>
    </tr>
    <?php
    foreach ($resultSet as $fila) { ?>
        <tr>
            <td><a href=   'tipoExamen-ficha.php?id=<?=$fila["id"]?>'> <?=$fila["nombre"] ?> </a></td>
            <td><a href='tipoExamen-eliminar.php?id=<?=$fila["id"]?>'> [X]                   </a></td>
        </tr>
    <?php } ?>
</table>
<br>

<a href='tipoExamen-ficha.php?id=-1'>Crear nueva entrada</a>

<br><br>

<a href="examen-listado.php">Gestionar calendario de exámenes.</a>


</body>
</html>
