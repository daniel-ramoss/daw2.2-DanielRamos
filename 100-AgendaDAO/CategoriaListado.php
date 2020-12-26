<?php
require_once "_com/Dao.php";
require_once "_com/_Varios.php";
require_once "_com/Utilidades.php";

$conexionBD = obtenerPdoConexionBD();

$categorias=DAO::categoriaObtenerTodas();



/*
$sql = "SELECT id, nombre FROM categoria ORDER BY nombre ";

$select = $conexionBD->prepare($sql);

$select->execute([]);

$rs = $select->fetchAll();
*/
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<h1>Listado de Categorías</h1>

<table border='1'>

    <tr>
        <th>Nombre</th>
    </tr>

    <?php foreach ($categorias as $categoria) { ?>
        <tr>
            <td><a href=   'CategoriaFicha.php?id=<?=$categoria->getId()?>'> <?=$categoria->getNombre()?> </a></td>
            <td><a href='CategoriaEliminar.php?id=<?=$categoria->getId()?>'> (X)                   </a></td>
        </tr>
    <?php } ?>

</table>

<br />

<a href='CategoriaFicha.php?id=-1'>Crear entrada</a>

<br />
<br />

<a href='PersonaListado.php'>Gestionar listado de Personas</a>

</body>

</html>