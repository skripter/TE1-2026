<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

var_dump($_POST);echo "<br>";
extract($_POST, EXTR_OVERWRITE);

if(!is_numeric($ci)){ exit('Cedula incorrecta'); }
if(strlen($ci) < 7){ exit('Largo de cedula incorrecto'); }
if(strlen($ci) > 8){ exit('Largo de cedula incorrecto'); }

if(empty($nombre) or is_null($nombre) or $nombre==""){ exit('Ingrese un nombre'); }
//if(!ctype_alpha($nombre)){ exit('Ingrese un nombre'); }

if(!is_numeric($departamento) or $departamento < 1){ exit('Departamento incorrecto'); }
?>