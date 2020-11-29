<?php
require_once "_Varios.php";

$conexion=obtenerPdoConexionBD();

$existeUsuario=(!haySesionIniciada());

if($existeUsuario){
    $usuario=obtenerUsuario();
}
$id=$usuario[0];
$identificador=$usuario[1];
$contrasenna=$usuario[2];
$nombre=$usuario[3];
$apellidos=$usuario[4];
/*
$id=(int)$_SESSION["id"];
$identificador=$_SESSION["identificador"];
$nombre=$_SESSION["nombre"];
$apellidos=$_SESSION["apellidos"];
$contrasenna=$_SESSION["contrasenna"];
*/
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<h1>Iniciar Sesión</h1>

<?php if($existeUsuario){ ?> <!-- si existe el usuario aparecen nada mas identificador y contraseña -->
        <form method='post' action='SesionInicioComprobar.php'>
            <input type='hidden' name='id' value='<?=$id?>'>
                <ul>
                    <li>
                        <label><strong>IDENTIFICADOR</strong></label>
                        <input type='text' name='identificador' value='<?=$identificador?>'>
                    </li>
                    <li>
                        <label><strong>CONTRASEÑA</strong></label>
                        <input type='text' name='contrasenna' value='<?=$contrasenna?>'>
                    </li>
                </ul>
        </form>
        <input type='submit' name='iniciaSesion' value='Iniciar Sesion'>
<?php }else { ?> <!-- si no existe metemos parámetros nombre, apellidos, identificador y contraseña y guardamos en la BD -->
        <form method='post' action='SesionInicioComprobar.php'>
            <input type='hidden' name='id' value='<?=$id?>'>
                <ul>
                    <li>
                        <label><strong>NOMBRE</strong></label>
                        <input type='text' name='nombre' value='<?=$nombre?>'>
                    </li>
                    <li>
                        <label><strong>APELLIDOS</strong></label>
                        <input type='text' name='apellidos' value='<?=$apellidos?>'>
                    </li>
                    <li>
                        <label><strong>IDENTIFICADOR</strong></label>
                        <input type='text' name='identificador' value='<?=$identificador?>'>
                    </li>
                    <li>
                        <label><strong>CONTRASEÑA</strong></label>
                        <input type='text' name='contrasenna' value='<?=$contrasenna?>'>
                    </li>
                </ul>
        </form>
        <input type='submit' name='iniciaSesion' value='Iniciar Sesion'>
<?php
}
?>

<!--
llamad a los campos IGUAL que en la BD:
identificador
contrasenna
-->
</body>

</html>
