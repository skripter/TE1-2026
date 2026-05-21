<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);
if($_POST){
asort($_POST);
var_dump($_POST);echo "<br>";
extract($_POST, EXTR_OVERWRITE);

/*if($a < $b and $b < $c){ $minimo=$a; $medio=$b; $maximo=$c;}
if($a < $c and $c < $b){ $minimo=$a; $medio=$c; $maximo=$b;}
if($c < $a and $a < $b){ $minimo=$c; $medio=$a; $maximo=$b;}
if($c < $b and $b < $a){ $minimo=$c; $medio=$b; $maximo=$a;}
if($b < $c and $c < $a){ $minimo=$b; $medio=$c; $maximo=$a;}
if($b < $a and $a < $c){ $minimo=$b; $medio=$a; $maximo=$c;}
echo "Minimo: ".$minimo." *** Medio: ".$medio." *** Maximo: ".$maximo;*/
}//Fin $_POST
?>
<html>
<head>
<title>Ordenar 3 numeros</title>
</head>
<body>
<form method='POST' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
A&nbsp;<input type='number' name='a' required autofocus>
<br><br>
B&nbsp;<input type='number' name='b' required>
<br><br>
C&nbsp;<input type='number' name='c' required>
<br><br>
<input type='submit' value='Ordenar' name='guardar'>
</form>
</body>
</html>