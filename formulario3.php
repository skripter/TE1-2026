<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);
if($_POST){
var_dump($_POST);echo "<br>";
extract($_POST, EXTR_OVERWRITE);

if(!is_numeric($ci)){ exit('Cedula incorrecta'); }
if(strlen($ci) < 7){ exit('Largo de cedula incorrecto'); }
if(strlen($ci) > 8){ exit('Largo de cedula incorrecto'); }

if(empty($nombre) or is_null($nombre) or $nombre==""){ exit('Ingrese un nombre'); }

if(!is_numeric($departamento) or $departamento < 1){ exit('Departamento incorrecto'); }
}//Fin $_POST
?>
<html>
<head>
<title>Formulario 3 - Check de variables</title>
</head>
<body>
<form method='POST' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
Cedula&nbsp;<input type='text' name='ci' maxlength='8' required autofocus>
<br><br>
Nombre&nbsp;<input type='text' name='nombre' required>
<br><br>
<select name='departamento' required>
<option value=''>Seleccione depto.</option>
<option value='1'>Salto</option>
<option value='2'>Paysandu</option>
<option value='3'>Rio Negro</option>
</select>
<br><br>
Seteado?<input type='checkbox' name='seteado'>
<br><br>
Vacunas:<br>
<input type='radio' name='vacunas' value='antirrabica'>Antirrabica<br>
<input type='radio' name='vacunas' value='jovenedad'>Joven edad<br>
<input type='radio' name='vacunas' value='antiparasitaria'>Antiparasitaria<br>
<input type='radio' name='vacunas' value='toxoplasmosis'>Toxoplasmosis<br>
<br><br>
<input type='submit' value='Guardar' name='guardar'><br><br>
<input type='submit' value='Borrar' name='borrar'>
</form>
</body>
</html>