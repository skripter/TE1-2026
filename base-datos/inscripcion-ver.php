<?php
//ini_set('display_errors', '1');
//error_reporting(E_ALL);
session_start();
require('./inscriptos-db.php');
$mensajeok = NULL;
$mensajeerror = NULL;
if(!$_GET){
$mensajeerror = 'No hay datos.';
}//fin if !$_GET

extract($_GET,EXTR_OVERWRITE);

if(!is_numeric($insid) or $insid < 1 ){
    $mensajeerror = 'ID inválido.';
}
?>
<html>
<head>
<title>Inscriptos</title>
<meta charset='UTF-8'>
<link href='/bootstrap-5.3.8-dist/css/bootstrap.css' rel='stylesheet' type='text/css'>
</head>
<body>
<div class='container-fluid'>
	<header class='alert alert-primary text-center mt-1'>
	<h1><a href='/'>Sorteo "La Catalina"</a></h1>
	</header>
	
	<!--nav class='navbar navbar-expand-lg navbar-primary bg-light mb-3 text-center  border border-dark rounded p-1'>
	<a href='#'>Inicio</a> |
	<a href='#'>Productos</a> | 
	<a href='#'>Noticias</a> | 
	<a href='#'>Clientes</a> | 
	<a href='#'>Escritores</a> | 
	<a href='#'>Ayuda</a>
	</nav-->
	
	<section>
	<?php //include('menu-lateral.php'); ?>
	</section>
	
<article>

	<?php if(isset($mensajeerror)){ ?>
	<div class='alert alert-danger' role='alert'>
		<?php echo $mensajeerror; ?>
	</div>
	<?php unset($mensajeerror); } ?>

	<?php if(isset($mensajeok)){ ?>
	<div class='alert alert-success' role='alert'>
		<?php echo $mensajeok; ?>
	</div>
	<?php unset($mensajeok); } ?>
<table class='table table-striped table-hover'>
<caption>Listado de inscriptos</caption>
<tr>
	<th>Cedula</th>
	<th>Nombre</th>
	<th>Celular</th>
	<th>Mail</th>
</tr>
<?php
$sql = "SELECT * FROM inscriptos WHERE insid = ".$insid;
echo $sql;
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) < 1 ){
	echo "<tr>";
	echo "<td colspan='4'>No se encontraron datos.</td>";
	echo "</tr>";
}//fin if

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	echo "<tr>\n";
	echo "<td>".$row['insci']."</td>\n";
	echo "<td>".$row['insnombre']."</td>\n";
	echo "<td>".$row['inscelular']."</td>\n";
	echo "<td>".$row['inscorreo']."</td>\n";
	echo "</tr>\n";
}//fin while
?>
</table>
<br>
</article>
<footer>
	&copy; TDA1 2025
</footer>
</div><!-- fin contenedor -->
</body>
</html>