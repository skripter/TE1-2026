<?php
//ini_set('display_errors', '1');
//error_reporting(E_ALL);
session_start();
require('./inscriptos-db.php');
$mensajeok = NULL;
$mensajeerror = NULL;
if($_POST){

extract($_POST,EXTR_OVERWRITE);

if(!is_numeric($insci) or $insci < 1 or strlen($insci) < 7){
    $mensajeerror = 'Cédula inválida.';
}

if(empty($insnombre) or strlen($insnombre) < 5){
    $mensajeerror = 'Nombre inválido.';
}

if(empty($inscelular) or strlen($inscelular) < 9){
    $mensajeerror = 'Número de celular inválido.';
}
if(!$mensajeerror){
$insci = mysqli_real_escape_string($conn, $insci);
$insnombre = mysqli_real_escape_string($conn, $insnombre);
$inscelular = mysqli_real_escape_string($conn, $inscelular);
$inscorreo = mysqli_real_escape_string($conn, $inscorreo);

$sql = "INSERT INTO inscriptos (insci, insnombre, inscelular, inscorreo) VALUES ('".$insci."', '".$insnombre."', '".$inscelular."', '".$inscorreo."')";
//echo $sql;
mysqli_query($conn, $sql) or exit("Error al guardar inscripción: ".mysqli_error($conn));
$mensajeok = 'Inscripción guardada con éxito. C.I.: '.$insci;
unset($insci, $insnombre, $inscelular, $inscorreo);
}//fin if !$mensajeerror
}//fin if $_POST
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

<form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='POST'>
	<div class='col-4 offset-4'>
	<input type='number' class='form-control mb-1' name='insci' min='1' placeholder='Cedula' value='<?php echo $insci; ?>' required autofocus>
	<input type='text' class='form-control mb-1' name='insnombre' placeholder='Nombre' value='<?php echo $insnombre; ?>' required>
	<input type='text' class='form-control mb-1' name='inscelular' placeholder='Celular' value='<?php echo $inscelular; ?>' required>
	<input type='email' class='form-control mb-1' name='inscorreo' placeholder='Mail' value='<?php echo $inscorreo; ?>'>
	<button type='submit' value='Guardar' class='btn btn-primary m-1 text-center' style='width: 100%;'><img src='/images/famfamfam-silk-master/dist/png/add.png' alt='Guardar'>&nbsp;Guardar inscripción</button>

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
	$ci_rec = "*****".substr($row['insci'], -3);
	echo "<td>".$ci_rec."</td>\n";
	echo "<td>".$row['insnombre']."</td>\n";
	echo "<td>".$row['inscelular']."</td>\n";
	$partescorreo = explode("@", $row['inscorreo']);
	$caracteresantesarroba = strlen($partescorreo[0])-3;
	//echo "<td>".str_repeat("*", $caracteresantesarroba).substr($partescorreo[0],-2)."@".$partescorreo[1]."</td>\n";
	echo "<td>".substr($partescorreo[0],0,3).str_repeat("*", $caracteresantesarroba)."@".$partescorreo[1]."</td>\n";
	echo "<td><a href='./inscripcion-ver.php?insid=".$row['insid']."'>Ver detalle</a></td>\n";
	echo "</tr>\n";
}//fin while
?>
</table>
<br>
<a href='./inscripcion-sortear.php'>Sortear</a>
</article>
<footer>
	&copy; TDA1 2025
</footer>
</div><!-- fin contenedor -->
</body>
</html>