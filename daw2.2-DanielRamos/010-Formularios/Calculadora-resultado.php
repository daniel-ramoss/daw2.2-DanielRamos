<!--
contendrá en el primer bloque PHP:
recogerá los datos del formulario
$operando1 = ... $operacion = $_REQUEST["operacion"]; $operando2 = ...
realizará los cálculos
if ($operacion == "sum") {          $resultado = _ + _; } else if ($operacion == "res") {          ... } ...
depositará el $resultado en una variable
informará de si $errorDivCero mediante otra variable true/false
durante la parte html comprobará o mostrará los valores de las variables
preparadas arriba en el lugar adecuado, para presentar con ello el resultado de la operación
-->
<?php
$operando1=$_REQUEST["operando1"];
$operacion=$_REQUEST["operacion"];
$operando2=$_REQUEST["operando2"];

$suma=$operando1+$operando2;
$resta=$operando1-$operando2;
$multi=$operando1*$operando2;
$division=$operando1/$operando2;
?>

<html>
<head>
    <h3>RESULTADO: </h3>
</head>
<body>
<?php
if($operacion=="sum"){
    echo "<p>$operando1 + $operando2 = $suma</p>";
}elseif ($operacion=="res"){
    echo "<p>$operando1 - $operando2 = $resta</p>";
}elseif ($operacion=="mul"){
    echo "<p>$operando1 * $operando2 = $multi</p>";
}else {
    if($operando2>0){
        echo "<p>$operando1 / $operando2 = $division</p>";
    }else{
        echo "<h4>ERROR (division entre 0) [$operando1 / $operando2]</h4>";
        
    }

}

?>

</body>
</html>
