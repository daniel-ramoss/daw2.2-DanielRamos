<?php
require_once "_Varios.php";

$conexion=obtenerPdoConexionBD();
if (haySesionIniciada()) {
    $existeUsuario=true;
} else {
    $existeUsuario=false;
}
/*
$usuario=obtenerUsuario(identificador, contrasenna);
if ($usuario != null){
    $existeUsuario=true;
    marcarSesionComoIniciada();
} else {
    $existeUsuario=false;
}
*/

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<h1>Iniciar Sesión</h1>

<form action='SesionInicioComprobar.php' method='post'>
    <label><strong>NOMBRE USUARIO: </strong></label>
    <input type='text' name='identificador' value='Usuario...'>
    <br><br>
    <label><strong>CONTRASEÑA: </strong></label>
    <input type='text' name='contrasenna' value='Contraseña...'>
    <br><br>
    <input type='submit' name='iniciarSesion' value='Iniciar Sesión'>
</form>

<br><br>
<a href='ContenidoPublico1.php'>Mostrar Contenido Público</a>

<!--
llamad a los campos IGUAL que en la BD:
identificador
contrasenna
-->
</body>

</html>


