<?php
    require_once "_com/DAO.php";

$persona = DAO::personaCrear($_REQUEST["nombre"], $_REQUEST["apellidos"], $_REQUEST["telefono"],
                             $_REQUEST["categoriaId"],false);

    echo json_encode($persona);
?>