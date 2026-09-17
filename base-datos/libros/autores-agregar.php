<?php
//ini_set('display_errors', '1');
//error_reporting(E_ALL);
session_start();
require('./db.php');
////////////////////////////////////////////////
if($_POST){
	$autdob = date('Y-m-d');
	extract($_POST,EXTR_SKIP);
	if(empty($autnom) or strlen($autnom) < 5){
		$_SESSION['msgerror'] = 'Nombre inválido.';
		header('Location: ./autores-editar.php?autid='.$autid);
		exit("Nombre inválido.");
	}//fin if
	$autnom = mysqli_real_escape_string($conn, $autnom);
	$autdob = mysqli_real_escape_string($conn, $autdob);
	$sql = "INSERT INTO autores (autnom, autdob) VALUES ('".$autnom."', '".$autdob."')";
	mysqli_query($conn, $sql) or exit("Error al agregar autor: ".mysqli_error($conn));
	$_SESSION['msgok'] = 'Autor agregado con éxito: '.$autnom;
	header('Location: ./autores-listar.php');
	exit();
}//fin if POST
?>
<html>
<head>
<title>Editar autor</title>
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
<form action='./autores-agregar.php' method='POST'>
	<p>
		<label for='autnom'>Nombre del Autor:</label>
		<input type='text' name='autnom' id='autnom' value='<?php echo $autnom; ?>' required>
	</p>
	<p>
		<label for='autdob'>Fecha de Nacimiento:</label>
		<input type='date' name='autdob' id='autdob' value='<?php echo $autdob; ?>'>
	</p>
	<p>
		<input type='submit' value='Agregar Autor'> <a href='./autores-listar.php'>Cancelar</a>
	</p>
</form>
</article>
	
<footer>
	&copy; TDA1 2025
</footer>
</div><!-- fin contenedor -->
</body>
</html>