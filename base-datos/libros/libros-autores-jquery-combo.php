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
	echo "<option value=''>No se encontraro raza de esta especie.</option>";
}//fin if

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	echo "<option value='".$row['autid']."'>".$row['libid']." - ".$row['libnom'];
	echo "</option>\n";
}//fin while
?>