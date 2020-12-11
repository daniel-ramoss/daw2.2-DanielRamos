<?php


declare(strict_types=1);


function obtenerPdoConexionBD(): PDO
{
    $servidor = "localhost";
    $bd = "MiniFb";
    $identificador = "root";
    $contrasenna = "";
    $opciones = [
        PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    ];

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
    } catch (Exception $e) {
        error_log("Error al conectar: " . $e->getMessage()); // El error se vuelca a php_error.log
        exit('Error al conectar'); //something a user can understand
    }

    return $conexion;
}

// (Esta función no se utiliza en este proyecto pero se deja por si se optimizase el flujo de navegación.)
// Esta función redirige a otra página y deja de ejecutar el PHP que la llamó:
function redireccionar(string $url)
{
    header("Location: $url");
    exit;
}


// (Esta función no se utiliza en este proyecto pero se deja por si se optimizase el flujo de navegación.)
function syso(string $contenido)
{
    file_put_contents('php://stderr', $contenido . "\n");
}

//////////////////////////////////////////////////// FUNCIONES PARA SESIONES

session_start(); // iniciamos la sesion


function obtenerUsuario(string $identificador, string $contrasenna): ?array
{
    $conexion =obtenerPdoConexionBD();
    $sql ="SELECT * FROM Usuario WHERE identificador=? AND contrasenna=?";
    $select = $conexion->prepare($sql);
    $select->execute([$identificador, $contrasenna]);
    $unaFilaAfectada = ($select->rowCount() == 1);
    $resultSet = $select->fetchAll();

    return $unaFilaAfectada ? $resultSet[0] : null;

    // TODO Pendiente hacer.
    // "SELECT * FROM Usuario WHERE identificador=? AND contrasenna=?"
    // Conectar con BD, lanzar consulta, ver si viene 1 fila o ninguna...
    // Devolver una cosa u otra para que sepan (true/false).
    //return $rs[0];
    //return ["id" => 17, "identificador" => "jlopez", ...];
}


function marcarSesionComoIniciada(array $arrayUsuario)
{
    $_SESSION["id"]=$arrayUsuario["id"];
    $_SESSION["identificador"]=$arrayUsuario["identificador"];
    $_SESSION["contrasenna"]=$arrayUsuario["contrasenna"];
    $_SESSION["nombre"]=$arrayUsuario["nombre"];
    $_SESSION["apellidos"]=$arrayUsuario["apellidos"];
    // TODO Anotar en el post-it todos estos datos:
    // $_SESSION["id"] = ...
    // ...
}


function haySesionIniciada(): bool // COMO REALIZAR LA COMPROBACIÓN
{
    $sesionIniciada=true;
    if(isset($_SESSION["id"])){
        $_SESSION["sesionIniciada"]=true;
        return $sesionIniciada;
    }else {
        $_SESSION["sesionIniciada"]=false;
        return false;
    }

    // TODO Pendiente hacer la comprobación.
    // Está iniciada si isset($_SESSION["id"])
    //return false;
}


function cerrarSesion()
{
    session_destroy();
    unset($_SESSION);
    setcookie("identificador", "");
    setcookie("codigoCookie", "");

    // TODO session_destroy() y unset (por si acaso).
}

///////////////////////////////////////////////// COOKIES

function haySesionRamIniciada(): bool
{
    if(haySesionIniciada()){
        return isset($_SESSION["id"]);
    } else {
        return false;
    }
    // Está iniciada si isset($_SESSION["id"])
    //return isset($_SESSION["id"]);
}


function intentarCanjearSesionCookie(): bool
{
    if (isset($_COOKIE["identificador"]) && isset($_COOKIE["codigoCookie"])){
        $conexion=obtenerPdoConexionBD();
        $usuario=obtenerUsuario();
        marcarSesionComoIniciada($usuario);
        setcookie("identificador", $usuario["identificador"], time()+60);
        setcookie("codigoCookie", $usuario["codigoCookie"], time()+60);
        return true;
    } else {
        setcookie("identificador", "", time()-3600);
        setcookie("codigoCookie", "", time()-3600);
        return false;
    }
    // TODO Comprobar si hay una "sesión-cookie" válida:
    //   - Ver que vengan DOS cookies "identificador" y "codigoCookie".
    //   - BD: SELECT ... WHERE identificador=? AND BINARY codigoCookie=?
    //   - ¿Ha venido un registro? (Igual que el inicio de sesión)
    //     · Entonces, se la canjeamos por una SESIÓN RAM INICIADA: marcarSesionComoIniciada($arrayUsuario)
    //     · Además, RENOVAMOS (re-creamos) la cookie.
    //   - IMPORTANTE: si las cookies NO eran válidas, tenemos que borrárselas.
    //   - En cualquier caso, devolver true/false.
}


function pintarInfoSesion()
{
    if (haySesionRamIniciada()) {
        echo "<span>Sesión iniciada por <a href='UsuarioPerfilVer.php'>$_SESSION[identificador]</a> ($_SESSION[nombre] $_SESSION[apellidos]) </span>";
    } else {
        echo "<a href='SesionInicioMostrarFormulario.php'>Iniciar sesión</a>";
    }
}


function generarCookieRecordar(array $arrayUsuario)
{
    $codigoCookie = generarCadenaAleatoria(32);
    $conexion=obtenerPdoConexionBD();
    $sql="UPDATE Usuario SET codigoCookie=? WHERE identificador=?";
    $parametros=[$codigoCookie, $arrayUsuario["identificador"]];
    $sentencia = $conexion->prepare($sql);
    $sqlConExito = $sentencia->execute($parametros);

    if ($sqlConExito){
        $arrayUsuario["codigoCookie"]=$codigoCookie;
        setcookie("identificador", $arrayUsuario["identificador"], time()+(60));
        setcookie("codigoCookie", $codigoCookie, time()+(60));
    }




    // Creamos un código cookie muy complejo (no necesariamente único).
    //$codigoCookie = generarCadenaAleatoria(32); // Random...
    // TODO guardar código en BD
    // TODO Para una seguridad óptima convendría anotar en la BD la fecha de caducidad de la cookie y no aceptar ninguna cookie pasada dicha fecha.
    // TODO Enviamos al cliente, en forma de cookies, el identificador y el codigoCookie: setcookie(...) ...
}

function borrarCookieRecordar(array $arrayUsuario)
{
    $conexion=obtenerPdoConexionBD();
    $sql="DELETE FROM Usuario WHERE codigoCookie=?";
    $parametros=[$arrayUsuario["codigoCookie"]];
    $sentencia = $conexion->prepare($sql);
    $sqlConExito = $sentencia->execute($parametros);

    if ($sqlConExito) {
        setcookie("identificador", "", time()-3600);
        setcookie("codigoCookie", "", time()-3600);
    }


    // TODO Eliminar el código cookie de nuestra BD.
    // TODO Pedir borrar cookie (setcookie con tiempo time() - negativo...)
}


function generarCadenaAleatoria($longitud): string
{
    for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != $longitud; $x = rand(0,$z), $s .= $a[$x], $i++);
    return $s;
}






