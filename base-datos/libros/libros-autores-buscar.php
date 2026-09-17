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
    $("#buscar").on("keyup", function(){
        var buscar = $("#buscar").val();
		if(buscar.length > 1){
        $("#visor").load("libros-autores-jquery-buscar.php?buscar="+buscar);
		}//fin if buscar length
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
<input type='text' name='buscar' id='buscar' autofocus>
<div id="visor">&nbsp;</div>	
</form>	

</article>
	
<footer>
	&copy; TDA1 2025
</footer>
</div><!-- fin contenedor -->
</body>
</html>