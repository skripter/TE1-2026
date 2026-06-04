<?php
//ini_set('display_errors', '1');
//error_reporting(E_ALL);
session_start();
require('./db.php');
?>
<html>
<head>
<title>Departamentos</title>
<meta charset='UTF-8'>
<link href='/bootstrap-5.3.8-dist/css/bootstrap.css' rel='stylesheet' type='text/css'>
</head>
<body>
<table class='table table-hover table-striped'>
<caption>Listado de Departamentos</caption>
<tr>
	<th>ID</th>
	<th>Nombre</th>
	<th></th>
</tr>
<?php
$sql = "SELECT * FROM departamentos";
//echo $sql;
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) < 1 ){
	echo "<tr>";
	echo "<td colspan='2'>No se encontraron datos.</td>";
	echo "</tr>";
}//fin if
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	echo "<tr>\n";
	echo "<td>".$row['Dptcod']."</td>\n";
	echo "<td>".$row['Dptnom']."</td>\n";
	echo "<td><a href='./localidades-ver.php?dptcod=".$row['Dptcod']."' class='btn btn-primary'>Ver localidades</td>\n";
	echo "</tr>\n";
}//fin while
?>
</table>

</body>
</html>