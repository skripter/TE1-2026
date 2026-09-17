<?php
//ini_set('display_errors', '1');
//error_reporting(E_ALL);
session_start();
require('./db.php');
?>
<html>
<head>
<title>Autores</title>
<meta charset='UTF-8'>
<link href='./estilo-diagramacion.css' rel='stylesheet' type='text/css'>
</head>
<body>
<div class='contenedor'>
	<header>
	<a href='/'>Biblioteca "La Catalina"</a>
	</header>
	
	<nav>
	<a href='#'>Inicio</a> |
	<a href='#'>Productos</a> | 
	<a href='#'>Noticias</a> | 
	<a href='#'>Clientes</a> | 
	<a href='#'>Escritores</a> | 
	<a href='#'>Ayuda</a>
	</nav>
	
	<section>
	<?php //include('menu-lateral.php'); ?>
	</section>
	
<article>
<?php
echo "<h4>".$_SESSION['msgerror']."</h4>";
echo "<h4>".$_SESSION['msgok']."</h4>";
unset($_SESSION['msgerror']);
unset($_SESSION['msgok']);
?>
<table class='tablita'>
<caption>Listado de Autores&nbsp;<a href='./autores-agregar.php'>+ Agregar</a></caption>
<tr>
	<th>ID</th>
	<th>Autor</th>
	<th>Fecha de Nac.</th>
	<th></th>
</tr>
<?php
$sql = "SELECT * FROM autores";
//echo $sql;
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) < 1 ){
	echo "<tr>";
	echo "<td colspan='2'>No se encontraron datos.</td>";
	echo "</tr>";
}//fin if
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	if(!is_null($row['autdob'])){
		$fechanac = date(' d/m/Y', strtotime($row['autdob']));
		}else{
		$fechanac = "Indeterminada";
		}
	echo "<tr>\n";
	echo "<td>".$row['autid']."</td>\n";
	echo "<td>".$row['autnom']."</td>\n";
	echo "<td>".$fechanac."</td>\n";
	echo "<td><a href='./autores-editar.php?autid=".$row['autid']."' title='".$row['autnom']."'>Editar</a></td>\n";
	echo "</tr>\n";
}//fin while
?>
</table>

</article>
	
<footer>
	&copy; TDA1 2025
</footer>
</div><!-- fin contenedor -->
</body>
</html>