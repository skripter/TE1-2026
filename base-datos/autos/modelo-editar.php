<?php
//ini_set('display_errors', '1');
//error_reporting(E_ALL);
session_start();
require('./db.php');
if($_POST){
	//var_dump($_POST);echo "<hr>";
	/*$marca = $_POST['marca'];
	$modelo = $_POST['modelo'];
	$anio = $_POST['anio'];
	$potencia = $_POST['potencia'];
	$cilindros = $_POST['cilindros'];
	$cilindrada = $_POST['cilindrada'];*/
	extract($_POST); // Extrae las variables del array $_POST y las convierte en variables individuales
	
	// Validar que los campos no estén vacíos
	if(empty($marca) || empty($modelo) || empty($anio) || empty($cilindros) || empty($cilindrada)){
		$_SESSION['msgerror'] = "Todos los campos son obligatorios.";
		header("Location: modelo-agregar.php");
		exit();
	}
	if(!is_numeric($marca) || !is_numeric($anio) || !is_numeric($potencia) || !is_numeric($cilindros) || !is_numeric($cilindrada)){
		$_SESSION['msgerror'] = "Marca, Año, Potencia, Cilindros y Cilindrada deben ser números.";
		header("Location: modelo-agregar.php");
		exit();
	}
	// Insertar el auto en la base de datos
	$query = "INSERT INTO modelos (modmarca, modnombre, modanio, modpotencia, modcilindros, modcilindrada) VALUES ('$marca', '$modelo', '$anio', '$potencia', '$cilindros', '$cilindrada')";
	//echo $query; //exit;// Para depuración, puedes eliminar esta línea en producción
	if(mysqli_query($conn, $query)){
		$_SESSION['msgok'] = "Auto agregado correctamente.";
		header("Location: modelos-por-marca.php?marid=$marca");
	} else {
		$_SESSION['msgerror'] = "Error al agregar el auto: " . mysqli_error($conn);
	}
	exit();
}//Fin POST
?>
<html>
<head>
<title>Marcas</title>
<meta charset='UTF-8'>
<link href='./estilo-diagramacion.css' rel='stylesheet' type='text/css'>
</head>
<body>
<div class='contenedor'>
	<header>
	<a href='/'>Garage "La Catalina"</a>
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
<form method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
	<label for='marca'>Marca:</label>
	<select name='marca' id='marca' required>
		<option value=''>Seleccione una marca</option>
		<?php
		// Obtener las marcas desde la base de datos
		$query = "SELECT marid, marnombre FROM marcas";
		$result = mysqli_query($conn, $query);
		
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<option value='".$row['marid']."'>".$row['marnombre']."</option>";
		}
		?>
	</select>
	<br>
	<label for='modelo'>Modelo:</label>
	<input type='text' name='modelo' id='modelo' required><br>
	<label for='anio'>Año:</label>
	<input type='number' name='anio' id='anio' min='1900' max='2099' required><br>
	<label for='potencia'>Potencia:</label>
	<input type='number' name='potencia' id='potencia' min='1' required><br>
	<label for='cilindros'>Cilindros</label>
	<input type='number' name='cilindros' id='cilindros' min='0' required><br>
	<label for='cilindrada'>Cilindrada</label>
	<input type='number' name='cilindrada' id='cilindrada' min='0' placeholder='En cm³' required><br>
	<input type='submit' value='Agregar Auto'>
</form>
</article>
	
<footer>
	&copy; TDA1 2025
</footer>
</div><!-- fin contenedor -->
</body>
</html>