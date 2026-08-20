<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);
session_start();
$_SESSION['mensaje'] = NULL;

if(!$_POST){
    $_SESSION['mensaje'] = 'No se recibieron datos para guardar.';
    header('Location: ./inscriptos-listar.php');
    exit("No se recibieron datos para guardar.");
}

require('./inscriptos-db.php');

extract($_POST,EXTR_OVERWRITE);

if(!is_numeric($insci) or $insci < 1/*000000 or $insci > 7000000*/){
    $_SESSION['mensaje'] = 'Cédula inválida.';
    header('Location: ./inscriptos-listar.php');
    exit("Cédula inválida.");

}

if(empty($insnombre) or strlen($insnombre) < 5){
    $_SESSION['mensaje'] = 'Nombre inválido.';
    header('Location: ./inscriptos-listar.php');
    exit("Nombre inválido.");
}

if(empty($inscelular) or strlen($inscelular) < 9){
    $_SESSION['mensaje'] = 'Número de celular inválido.';
    header('Location: ./inscriptos-listar.php');
    exit("Número de celular inválido.");
}

$insci = mysqli_real_escape_string($conn, $insci);
$insnombre = mysqli_real_escape_string($conn, $insnombre);
$inscelular = mysqli_real_escape_string($conn, $inscelular);
$inscorreo = mysqli_real_escape_string($conn, $inscorreo);

$sql = "INSERT INTO inscriptos (insci, insnombre, inscelular, inscorreo) VALUES ('".$insci."', '".$insnombre."', '".$inscelular."', '".$inscorreo."')";
//echo $sql;
mysqli_query($conn, $sql) or exit("Error al guardar inscripción: ".mysqli_error($conn));
$_SESSION['mensaje'] = 'Inscripción guardada con éxito. C.I.: '.$insci;
header('Location: ./inscriptos-listar.php');
?>