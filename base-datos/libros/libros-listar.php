<?php
//ini_set('display_errors', '1');
//error_reporting(E_ALL);
session_start();
require('./db.php');
?>
<html>
<head>
<title>Libros</title>
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

<table class='tablita'>
<caption>Listado de libros</caption>
<tr>
	<th>ID</th>
	<th>T&iacute;tulo</th>
	<th>Autor</th>
	<th>ISBN</th>
	<th></th>
</tr>
<?php
$sql = "SELECT * FROM libros ";
$sql .= "INNER JOIN autores ON libros.libautor = autores.autid ";
$sql .= "ORDER BY libnom";
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
	echo "<td>".$row['libisbn']."</td>\n";
	echo "<td><a href='./libros-ver-resenia.php?libid=".$row['libid']."'>Leer rese&ntilde;a</td>\n";
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