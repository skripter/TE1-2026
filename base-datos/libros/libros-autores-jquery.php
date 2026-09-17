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
<script src="/js/jquery-3.7.1.min.js"></script>
<script>
$(function(){
    $("#autid").on("change", function(){
        var autid = $("#autid option:selected").val();
        $("#visor").load("libros-autores-jquery-mostrar.php?autid="+autid);
        $("#libid").load("libros-autores-jquery-combo.php?autid="+autid);
    });//Fin petspecie
});//Fin $
</script>    
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
<form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='POST'>
<?php
echo "<h4>$msgerror</h4>";
echo "<h4>$msgok</h4>";
?>
	<table>
	<caption>Datos del autor</caption>
	<tr>
	<td>Autor:</td>
	<td>
	<select name='autid' id='autid'>
	<option value="">Seleccione autor</option>
	<?php
	$sql = "SELECT * FROM autores";
	//echo $sql;
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	echo "<option value='".$row['autid']."'>";
	echo $row['autid']." - ".$row['autnom']."</option>\n";
}//fin while
	?>
	</select>
	</td>
	</tr>
	
	<tr>
	<td>Libros:</td>
	<td>
	<select name='libid' id='libid'>
	<option value="">Seleccione autor primero</option>
	</select>
	</td>
	</tr>
	</table>
<div id="visor">&nbsp;</div>	
</form>	

</article>
	
<footer>
	&copy; TDA1 2025
</footer>
</div><!-- fin contenedor -->
</body>
</html>