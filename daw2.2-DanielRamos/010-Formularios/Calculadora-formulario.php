<!--
contendrá un form con un input number para el operando 1 (name="operando1")
un select para la operación,
con cuatro opciones (name del select = "operacion",
values de los option = "sum", "res", "mul", "div")
<select name="operacion">
<option value="volvo">Volvo</option>
<option value="saab">Saab</option>
<option value="mercedes">Mercedes</option>
<option value="audi">Audi</option> </select>
un input number para el operando 2 (name="operando2")
un submit para enviar el formulario
-->
<?php

?>
<html>
<head>
    <h1>CALCULADORA BÁSICA</h1>
</head>
<body>
<form action="Calculadora-resultado.php" method="post">
    <input type="number" name="operando1">
    <select name="operacion">
        <option value="sum"> Suma </option>
        <option value="res"> Resta </option>
        <option value="mul"> Multiplicación </option>
        <option value="div"> División </option>
    </select>
    <input type="number" name="operando2">
    <input type="submit" name="boton-enviar" value="Enviar">
</form>


</body>
</html>