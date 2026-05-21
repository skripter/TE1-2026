<html>
<head>
<title>Formulario 2 - Check de variables</title>
</head>
<body>
<form method='POST' action='procesar2.php'>
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