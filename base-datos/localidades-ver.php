<?php
//ini_set('display_errors', '1');
//error_reporting(E_ALL);
session_start();
if(!$_GET){ exit('Datos incorrectos.'); }
extract($_GET, EXTR_OVERWRITE);
if(!is_numeric($dptcod) or $dptcod < 1){ exit('Departamento incorrecto.'); }
require('./db.php');
$sql = "SELECT * FROM departamentos WHERE Dptcod='".$dptcod."' LIMIT 1";
//echo $sql;
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	$nombredepartamento = $row['Dptnom'];;
}//fin while
?>
<html>
<head>
<title>Localidades por departamento</title>
<meta charset='UTF-8'>
<link href='./estilo.css' rel='stylesheet' type='text/css'>
</head>
<body>
<table class='tablita'>
<caption>Listado de Localidades de: <?php echo $nombredepartamento; ?></caption>
<tr>
	<th>ID</th>
	<th>Nombre localidad</th>
</tr>
<?php
$sql = "SELECT * FROM localidades WHERE Dptcod='".$dptcod."' ORDER BY LocNom";
echo $sql;
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) < 1 ){
	echo "<tr>";
	echo "<td colspan='2'>No se encontraron datos.</td>";
	echo "</tr>";
}//fin if
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	echo "<tr>\n";
	echo "<td>".$row['Locid']."</td>\n";
	echo "<td>".$row['LocNom']."</td>\n";
	echo "</tr>\n";
}//fin while
?>
</table>

</body>
</html>