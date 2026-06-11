<?php
//ini_set('display_errors', '1');
//error_reporting(E_ALL);
session_start();
if(!$_GET){ exit('Datos incorrectos.'); }
extract($_GET, EXTR_OVERWRITE);
if(!is_numeric($marid) or $marid < 1){ exit('Marca incorrecta.'); }
require('./db.php');
$sql = "SELECT * FROM marcas WHERE marid='".$marid."' LIMIT 1";
//echo $sql;
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	$nombremarca = $row['marnombre'];
}//fin while
?>
<html>
<head>
<title>Modelos por marca</title>
<meta charset='UTF-8'>
<link href='./estilo-diagramacion.css' rel='stylesheet' type='text/css'>
</head>
<body>
<table class='tablita'>
<caption>Listado de modelos de: <?php echo $nombremarca; ?></caption>
<tr>
	<th>ID</th>
	<th>Marca</th>
	<th>Modelo</th>
	<th>Año</th>
	<th>Potencia</th>
</tr>
<?php
$sql = "SELECT * FROM modelos ";
$sql .= "INNER JOIN marcas ON marcas.marid=modelos.modmarca ";
$sql .= "WHERE modmarca='".$marid."' ORDER BY modnombre ";
//echo $sql;
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) < 1 ){
	echo "<tr>";
	echo "<td colspan='2'>No se encontraron datos.</td>";
	echo "</tr>";
}//fin if
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	echo "<tr>\n";
	echo "<td>".$row['modid']."</td>\n";
	echo "<td>".$row['marnombre']."</td>\n";
	echo "<td>".$row['modnombre']."</td>\n";
	echo "<td>".$row['modanio']."</td>\n";
	echo "<td>".$row['modpotencia']."</td>\n";
	echo "</tr>\n";
}//fin while
?>
</table>

</body>
</html>