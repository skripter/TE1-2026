<?php
//ini_set('display_errors', '1');
//error_reporting(E_ALL);
session_start();
if(!$_GET and !$_POST){
    $_SESSION['msgerror'] = 'No se recibieron datos para guardar.';
    header('Location: ./autores-listar.php');
    exit("No se recibieron datos para editar.");
}
require('./db.php');
if($_GET){
	extract($_GET,EXTR_OVERWRITE);
	if(!is_numeric($autid) or $autid < 1){
    	$_SESSION['msgerror'] = 'Autor inválido.';
   		header('Location: ./autores-listar.php');
   		exit("Autor inválido.");
	}
	$sql = "SELECT * FROM autores WHERE autid = ".$autid." LIMIT 1";
	$result = mysqli_query($conn, $sql) or exit("Error al consultar autor: ".mysqli_error($conn));
	if(mysqli_num_rows($result) < 1){
		$_SESSION['msgerror'] = 'Autor no encontrado.';
		header('Location: ./autores-listar.php');
		exit("Autor no encontrado.");
	}//fin if
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$autnom = $row['autnom'];
		$autdob = $row['autdob'];
	}//fin while
}//fin if GET
////////////////////////////////////////////////
if($_POST){
	extract($_POST,EXTR_OVERWRITE);
	if(!is_numeric($autid) or $autid < 1){
    $_SESSION['msgerror'] = 'Autor inválido.';
    header('Location: ./autores-listar.php');
    exit("Autor inválido.");
	}//fin if
	if(empty($autnom) or strlen($autnom) < 5){
		$_SESSION['msgerror'] = 'Nombre inválido.';
		header('Location: ./autores-editar.php?autid='.$autid);
		exit("Nombre inválido.");
	}//fin if
	$autnom = mysqli_real_escape_string($conn, $autnom);
	$autdob = mysqli_real_escape_string($conn, $autdob);
	$sql = "UPDATE autores SET autnom = '".$autnom."', autdob = '".$autdob."' WHERE autid = ".$autid;
	mysqli_query($conn, $sql) or exit("Error al actualizar autor: ".mysqli_error($conn));
	$_SESSION['msgok'] = 'Autor actualizado con éxito. ID: '.$autid;
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
<form action='./autores-editar.php' method='POST'>
	<input type='hidden' name='autid' value='<?php echo $autid; ?>'>
	<p>
		<label for='autnom'>Nombre del Autor:</label>
		<input type='text' name='autnom' id='autnom' value='<?php echo $autnom; ?>' required>
	</p>
	<p>
		<label for='autdob'>Fecha de Nacimiento:</label>
		<input type='date' name='autdob' id='autdob' value='<?php echo $autdob; ?>'>
	</p>
	<p>
		<input type='submit' value='Guardar Cambios'> <a href='./autores-listar.php'>Cancelar</a>
	</p>
</form>
</article>
	
<footer>
	&copy; TDA1 2025
</footer>
</div><!-- fin contenedor -->
</body>
</html>