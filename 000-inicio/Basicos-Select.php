<?php
    $ciudades = [
        3 => "Barcelona",
        1 => "Madrid",
        2 => "Bilbao",
        4 => "Cáceres",
        5 => "Sevilla",
        6 => "Valencia"];
?>
<html>
<head></head>
<body>
<select name="ciudadId">
    <option value="-1"> Elije </option>
    <?php foreach ($ciudades as $id => $nombreCiudad)
        echo "<option value='$id'> $nombreCiudad </option> \n";
    ?>
</select>
</body>
</html>
