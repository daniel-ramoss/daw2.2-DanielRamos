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
    <br>
    <label><strong>CONTRASEÑA: </strong></label>
    <input type='text' name='contrasenna' value='Contraseña...'>
    <br>
    <input type='submit' name='iniciarSesion' value='Iniciar Sesión'>
</form>
<br>

<?php
if (!haySesionIniciada()){?>
    <form action='SesionInicioComprobar.php' method='post'>
        <label><strong>NOMBRE: </strong></label>
        <input type='text' name='nombre' value='Nombre Usuario...'>
        <br>
        <label><strong>APELLIDOS: </strong></label>
        <input type='text' name='apellidos' value='Apellidos...'>
        <br>
        <label><strong>NOMBRE USUARIO: </strong></label>
        <input type='text' name='identificador' value='Usuario...'>
        <br>
        <label><strong>CONTRASEÑA: </strong></label>
        <input type='text' name='contrasenna' value='Contraseña...'>
        <br>
        <input type='submit' name='crearSesion' value='Crear Sesión'>
    </form>
    <br>

<?php
}
?>

<br><br>
<a href='ContenidoPublico1.php'>Mostrar Contenido Público</a>

<!--
llamad a los campos IGUAL que en la BD:
identificador
contrasenna
-->
</body>

</html>
