<?php
require_once "varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];

$nuevaPersona = ($id == -1);

if ($nuevaPersona) {
    $nombrePersona = "<introduzca nombre>";
    $telefonoPersona = "<introduzca su teléfono>";
    $idCategoria = "<introduzca el id de la categoría a la que pertenece>";
} else {
    $sql = "SELECT nombre, telefono, categoria_id FROM persona WHERE id=?";

    $select = $conexion->prepare($sql);
    $select->execute([]);
    $resultSet = $select->fetchAll();

    $nombrePersona = $resultSet[0]["nombre"];
    $telefonoPersona = $resultSet[1]["telefono"];
    $idCategoria = $resultSet[2]["categoria_id"];
}
?>


<html>

<head>
    <meta charset="UTF-8">
</head>



<body>

<?php if ($nuevaPersona) { ?>
    <h1>Nueva Persona</h1>
<?php } else { ?>
    <h1>Ficha de persona</h1>
<?php } ?>

<form method='post' action='persona-guardar.php'>

    <input type='hidden' name='id' value='<?=$id?>' />

    <ul>
        <li>
            <strong>Nombre: </strong>
            <input type='text' name='nombre' value='<?=$nombrePersona?>' />
        </li>
        <li>
            <strong>Teléfono: </strong>
            <input type='tel' name='telefono' value='<?=$telefonoPersona?>'>
        </li>
        <li>
            <strong>ID-Categoría: </strong>
            <input type='number' name='categoria_id' value='<?=$idCategoria?>'>
        </li>
    </ul>

    <?php if ($nuevaPersona) { ?>
        <input type='submit' name='crear-persona' value='Crear persona' />
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
    <?php } ?>

</form>

<br>

<a href="persona-eliminar.php?id=<?=$id ?>">Eliminar persona</a>

<br>
<br>

<a href="persona-listado.php">Volver a la lista de Personas.</a>

</body>

</html>
