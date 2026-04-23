<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

var_dump($_POST);echo "<br>";
extract($_POST, EXTR_OVERWRITE);

if(!is_numeric($var_a)){ exit('Var A incorrecta'); }
if(!is_numeric($var_b)){ exit('Var B incorrecta'); }

if($var_a > 10){ exit('Var A mayor a 10'); }
if($var_b > 10){ exit('Var B mayor a 10'); }

echo "Suma: ".$var_a + $var_b ."<br>";
echo "Producto: ".$var_a * $var_b ."<br>";
echo "Potencia: ".pow($var_a, $var_b) ."<br>";
?>