<?php
require_once "varios.php";

$conexion = obtenerPdoConexionBD();

$sql = "
               SELECT
                    p.id     AS p_id,
                    p.nombre AS p_nombre,
                    c.id     AS c_id,
                    c.nombre AS c_nombre
                FROM
                   persona AS p INNER JOIN categoria AS c
                   ON p.categoria_id = c.id
                ORDER BY p.nombre
        ";

$select = $conexion->prepare($sql);

$select->execute([]);

$resultSet = $select->fetchAll();

?>

<html>

<head>
    <meta charset="UTF-8">
</head>



<body>

<h1>Lista de Personas</h1>

<table border='1'>

    <tr>
        <th>Nombre</th>
    </tr>

    <?php
    foreach ($resultSet as $fila) { ?>
        <tr>
            <td><a href='persona-ficha.php?id=<?=$fila["id"]?>'> <?=$fila?></a></td>
            <td><a href='persona-eliminar.php?id=<?=$fila["id"]?>'> -Eliminar- </a></td>
        </tr>
    <?php } ?>

</table>

<br>

<a href="persona-ficha.php?id=-1">Crear Nueva Persona</a>

<br>
<br>

<a href="persona-listado.php">Gestionar listado de Personas</a>

</body>

</html>
