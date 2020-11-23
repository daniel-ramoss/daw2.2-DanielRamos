<?php
require_once "variosTrabajoFinal.php";

$conexion = obtenerPdoConexionBD();

$id=$_REQUEST["id"];

$sql = "UPDATE examen SET aprobado = (NOT(SELECT aprobado FROM examen WHERE id=?)) WHERE id=?";
$param=[$id, $id];

$sentencia = $conexion->prepare($sql);
$sentencia->execute($param);

redireccionar("examen-listado.php");

?>