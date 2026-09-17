<table class='tablita'>
<?php
//ini_set('display_errors', '1');
//error_reporting(E_ALL);

//Forma vieja y manual
//$autid = $_GET['autid'];
//Forma automatizada
extract($_GET,EXTR_OVERWRITE);
require('./db.php');
if(!is_numeric($autid) or $autid < 1){ exit("ID incorrecto"); }
$autid = mysqli_real_escape_string($conn, $autid);
$sql = "SELECT * FROM libros ";
$sql .= "INNER JOIN autores ON libros.libautor = autores.autid ";
$sql .= "WHERE libautor='".$autid."'";
//echo $sql;
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) < 1 ){
	echo "<tr>";
	echo "<td colspan='2'>No se encontraron datos.</td>";
	echo "</tr>";
}//fin if

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	echo "<tr>\n";
	echo "<td>".$row['libid']."</td>\n";
	echo "<td>".$row['libnom']."</td>\n";
	echo "<td>".$row['autid']." - ".$row['autnom']."</td>\n";
	echo "<td><a href='./libros-ver-resenia.php?libid=".$row['libid']."'>Leer rese&ntilde;a</td>\n";
	echo "</tr>\n";
}//fin while
?>
</table>