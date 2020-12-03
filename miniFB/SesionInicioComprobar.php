<?php
require_once "_Varios.php";

$identificador=$_REQUEST["identificador"];
$contrasenna=$_REQUEST["contrasenna"];
$arrayUsuario=obtenerUsuario($identificador,$contrasenna);

if ($arrayUsuario != null) {
    marcarSesionComoIniciada($arrayUsuario);
} else {
    redireccionar("SesionInicioMostrarFormulario.php");
}
// TODO ...$_REQUEST["..."]...
// TODO Verificar (usar funciones de _Varios.php) identificador y contrasenna recibidos y redirigir a contenido1 (si OK) o a iniciar sesión (si NO ok).
/*
$arrayUsuario = obtenerUsuario();

if ($arrayUsuario) { // HAN venido datos: identificador existía y contraseña era correcta.
    marcarSesionComoIniciada($arrayUsuario);
    redireccionar("ContenidoPrivado1.php");
    // TODO Llamar a marcarSesionComoIniciada($arrayUsuario) ...
    // TODO Redirigir.
} else {
    redireccionar("SesionInicioMostrarFormulario.php");
    // TODO Redirigir.
}
*/