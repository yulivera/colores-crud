<?php 

include_once 'conexion.php';

$sql_leer='SELECT *FROM colores';

$gsend=$pdo->prepare($sql_leer);
$gsent->execute();
$resultado=$gsent->fetchAll();

if ($_POST) {
	
	$color=$_POST['color'];
	$descripcion=$_POST['description'];

	$sql_agregar='INSERT INTO colores (color,descripcion) values (?,?)';

	$sentencia_agregar=$pdo->prepare($sql_agregar);
	$sentencia_agregar->execute(array($color,$description));

	header('location:index.php');
}

 ?>