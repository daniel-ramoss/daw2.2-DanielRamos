<?php
// TODO ...$_REQUEST["..."]...
// TODO Intentar crear (añadir funciones en Varios.php para crear y tal).
// TODO Y redirigir a donde sea.
//$arrayUsuario = crearUsuario($identificador, $contrasenna, ....);
// TODO ¿Excepciones?
//if ($arrayUsuario) {
/*} else {

}
*/
require_once "_com/_Varios.php";
require_once "_com/DAO.php";

if (isset($_REQUEST["nombre"])        && isset($_REQUEST["apellidos"]) &&
    isset($_REQUEST["identificador"]) && isset($_REQUEST["contrasenna"])){
    $nombre=$_REQUEST["nombre"];
    $apellidos=$_REQUEST["apellidos"];
    $identificador=$_REQUEST["identificador"];
    $contrasenna=$_REQUEST["contrasenna"];
    DAO::usuarioCrear($nombre, $apellidos, $identificador, $contrasenna);
    redireccionar("SesionInicioFormulario.php");
} else {
    redireccionar("UsuarioNuevoFormulario.php");
}


?>



