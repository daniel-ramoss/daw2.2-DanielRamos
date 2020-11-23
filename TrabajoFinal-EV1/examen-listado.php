<?php
require_once "variosTrabajoFinal.php";

$conexion = obtenerPdoConexionBD();

$sql = "SELECT
        ex.id       AS exId,
        ex.nombre   AS exNombre,
        ex.fecha    AS exFecha,
        ex.aprobado AS exAprobado, 
        ti.id       AS tiId,
        ti.nombre   AS tiNombre
        FROM examen AS ex INNER JOIN tipoexamen AS ti ON ex.tipoExamenId = ti.id
        ORDER BY ex.nombre";

$select = $conexion->prepare($sql);

$select->execute([]);

$resultSet = $select->fetchAll();

?>

<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<h1>Calendario de Exámenes</h1>
<table border='1'>

    <tr>
        <th>Nombre</th>
        <th>Tipo Examen Id</th>
        <th>Tipo Examen Nombre</th>
        <th>Fecha</th>
        <th>Aprobado</th>
        <th>Eliminar</th>

    </tr>

    <?php
    foreach ($resultSet as $fila) { ?>
        <tr>
            <td><a     href='examen-ficha.php?id=<?=$fila["exId"]?>'>  <?=$fila["exNombre"]?>       </a></td>
            <td><a     href='examen-ficha.php?id=<?=$fila["exId"]?>'>  <?=$fila["tiId"]?>           </a></td>
            <td><a     href='examen-ficha.php?id=<?=$fila["exId"]?>'>  <?=$fila["tiNombre"]?>       </a></td>
            <td><a     href='examen-ficha.php?id=<?=$fila["exId"]?>'>  <?=$fila["exFecha"]?>        </a></td>
            <td>
            <?php
            echo "";
            if ($fila["exAprobado"]) {
                $imagenTick = "Kliponious-green-tick.png";
                $paramTick = "tick";
            } else {
                $imagenTick = "x15.jpg";
                $paramTick= "";
            }
            echo "<a href='examen-estado-tick.php?$paramTick'><img src='$imagenTick' width='16' height='16'></a>";
            ?></td>
        <!--<td><a     href='examen-ficha.php?id=<?=$fila["exId"]?>'>  <?=$fila["exAprobado"]?>       </a></td> -->

            <td><a  href='examen-eliminar.php?id=<?=$fila["exId"]?>'>  [X]                          </a></td>
        </tr>
    <?php } ?>
</table>

<br>

<a href='tipoExamen-listado.php'>Volver al Listado de Tipos de Exámenes</a>

<br><br>

<a href='examen-ficha.php?id=-1'>Crear Nuevo Examen</a>

<br><br>
<!-- Aquí podemos añadir despúes las listas de exámenes aprobados y supensos -->

<a href='listado-examen-aprobados.php'>Lista de Exámenes Aprobados</a>

<br><br>

<a href='listado-examen-noAprobados.php'>Lista de Exámenes No Aprobados</a>

<br><br>


</body>
</html>
