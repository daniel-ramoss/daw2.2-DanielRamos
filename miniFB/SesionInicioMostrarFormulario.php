<?php
require_once "_Varios.php";

$conexion=obtenerPdoConexionBD();

if (haySesionIniciada()) {
    $existeUsuario=true;
    $usuario=obtenerUsuario();
} else {
    $existeUsuario=false;
}



?>



<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<h1>Iniciar Sesión</h1>

<?php if($existeUsuario){?> <!-- si existe el usuario aparecen nada mas identificador y contraseña -->
        <form method='post' action='SesionInicioComprobar.php'>
            <input type='hidden' name='id' value='<?=$usuario[0]?>'>
                <ul>
                    <li>
                        <label><strong>IDENTIFICADOR</strong></label>
                        <input type='text' name='identificador' value='<?=$usuario[1]?>'>
                    </li>
                    <li>
                        <label><strong>CONTRASEÑA</strong></label>
                        <input type='text' name='contrasenna' value='<?=$usuario[2]?>'>
                    </li>
                </ul>
        </form>
        <input type='submit' name='iniciaSesion' value='Iniciar Sesion'>
<?php }else { ?> <!-- si no existe metemos parámetros nombre, apellidos, identificador y contraseña y guardamos en la BD -->
        <form method='post' action='SesionInicioComprobar.php'>
            <input type='hidden' name='id' value='<?=$usuario[0]?>'>
                <ul>
                    <li>
                        <label><strong>NOMBRE</strong></label>
                        <input type='text' name='nombre' value='<?=$usuario[3]?>'>
                    </li>
                    <li>
                        <label><strong>APELLIDOS</strong></label>
                        <input type='text' name='apellidos' value='<?=$usuario[4]?>'>
                    </li>
                    <li>
                        <label><strong>IDENTIFICADOR</strong></label>
                        <input type='text' name='identificador' value='<?=$usuario[1]?>'>
                    </li>
                    <li>
                        <label><strong>CONTRASEÑA</strong></label>
                        <input type='text' name='contrasenna' value='<?=$usuario[2]?>'>
                    </li>
                </ul>
        </form>
        <input type='submit' name='creaSesion' value='Crear Sesion'>
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
