<?php
    require_once "_com/DAO.php";

    $persona = DAO::personaCrear($_REQUEST["personaNombre"],
                                 $_REQUEST["personaApellidos"],
                                 $_REQUEST["personaTelefono"],
                                 $_REQUEST["personaCategoria"]);

    echo json_encode($persona);
?>