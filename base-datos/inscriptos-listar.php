<?php
//ini_set('display_errors', '1');
//error_reporting(E_ALL);
session_start();
require('./inscriptos-db.php');
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

<form action='./inscriptos-guardar.php' method='POST'>
	<div class='col-4 offset-4'>
	<input type='number' class='form-control mb-1' name='insci' min='1' placeholder='Cedula' required autofocus>
	<input type='text' class='form-control mb-1' name='insnombre' placeholder='Nombre' required>
	<input type='text' class='form-control mb-1' name='inscelular' placeholder='Celular' required>
	<input type='email' class='form-control mb-1' name='inscorreo' placeholder='Mail'>
	<button type='submit' value='Guardar' class='btn btn-primary m-1 text-center' style='width: 100%;'><img src='/images/famfamfam-silk-master/dist/png/add.png' alt='Guardar'>&nbsp;Guardar inscripción</button>

	<?php if(isset($_SESSION['mensaje'])){ ?>
	<div class='alert alert-danger' role='alert'>
		<?php echo $_SESSION['mensaje']; ?>
	</div>
	<?php unset($_SESSION['mensaje']); } ?>
	</div><!-- fin col-4 -->

</form>

<table class='table table-striped table-hover'>
<caption>Listado de inscriptos</caption>
<tr>
	<th>Cedula</th>
	<th>Nombre</th>
	<th>Celular</th>
	<th>Mail</th>
	<th></th>
</tr>
<?php
$sql = "SELECT * FROM inscriptos ";
$sql .= "ORDER BY insid DESC LIMIT 10";
//echo $sql;
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) < 1 ){
	echo "<tr>";
	echo "<td colspan='2'>No se encontraron datos.</td>";
	echo "</tr>";
}//fin if

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	echo "<tr>\n";
	echo "<td>".$row['insid']."</td>\n";
	echo "<td>".$row['insci']."</td>\n";
	echo "<td>".$row['insnombre']."</td>\n";
	echo "<td>".$row['inscorreo']."</td>\n";
	echo "<td><a href='./inscriptos-ver.php?insid=".$row['insid']."'>Ver detalle</td>\n";
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