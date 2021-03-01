<?php

require_once "_com/Dao.php";

$conexion = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];
$nombre = $_REQUEST["nombre"];

$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
    // Quieren CREAR una nueva entrada, así que es un INSERT.
    $sql = "INSERT INTO Categoria (nombre) VALUES (?)";
    $parametros = [$nombre];
} else {
    // Quieren MODIFICAR una categoría existente y es un UPDATE.
    $sql = "UPDATE Categoria SET nombre=? WHERE id=?";
    $parametros = [$nombre, $id];
}