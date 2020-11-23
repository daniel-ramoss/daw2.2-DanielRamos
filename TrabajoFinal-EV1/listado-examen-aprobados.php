<?php
require_once "variosTrabajoFinal.php";

$conexion = obtenerPdoConexionBD();
//este PHP y el de examenesSuspensos podrían hacerse en el mismo de listado de examenes
$sql = " SELECT
        ex.id       AS exId,
        ex.nombre   AS exNombre,
        ex.fecha    AS exFecha,
        ex.aprobado AS exAprobado, 
        ti.id       AS tiId,
        ti.nombre   AS tiNombre
        FROM examen AS ex INNER JOIN tipoexamen AS ti ON ex.tipoExamenId = ti.id
        WHERE ex.aprobado = 1
        ORDER BY ex.nombre";

$select = $conexion->prepare($sql);

$select->execute([]);

$resultSet = $select->fetchAll();
?>

<html>
<head> <meta charset="UTF-8"> </head>
<body>
<h1>Listado de Exámenes Aprobados</h1>

<table border='1'>
    <tr>
        <th>Nombre</th>
        <th>Tipo Examen Id</th>
        <th>Tipo Examen Nombre</th>
        <th>Fecha</th>
        <th>Aprobado</th>
    </tr>
    <tr>
        <?php
        foreach ($resultSet as $filaAprobados) { ?>
    <tr>
        <td><a href='examen-ficha.php?id=<?=$filaAprobados["exId"]?>'>  <?=$filaAprobados["exNombre"]?>          </a></td>
        <td><a href='examen-ficha.php?id=<?=$filaAprobados["exId"]?>'>  <?=$filaAprobados["tiId"]?>              </a></td>
        <td><a href='examen-ficha.php?id=<?=$filaAprobados["exId"]?>'>  <?=$filaAprobados["tiNombre"]?>          </a></td>
        <td><a href='examen-ficha.php?id=<?=$filaAprobados["exId"]?>'>  <?=$filaAprobados["exFecha"]?>           </a></td>
  <!--  <td><a href='examen-ficha.php?id=<?=$filaAprobados["exId"]?>'>  <?=$filaAprobados["exAprobado"] ?>       </a></td> -->
        <td>
            <?php
            echo "";
            if ($filaAprobados["exAprobado"]) {
                $imagenTick = "Kliponious-green-tick.png";
                $paramTick = "tick";
            } else {
                $imagenTick = "x15.jpg";
                $paramTick= "";
            }
            echo "<a href='examen-estado-tick.php?$paramTick'><img src='$imagenTick' width='16' height='16'></a>";
            ?></td>
    </tr>
    <?php } ?>
    </tr>
</table>

<br><br>

<a href='examen-listado.php'>Volver al Calendario de Exámenes.</a>

<br><br>

<a href='listado-examen-noAprobados.php'>Mostrar Listado de Exámenes No Aprobados</a>

</body>
</html>
