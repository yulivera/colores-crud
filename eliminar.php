<?php 

include_once 'conexion.php';
// resivir atravez de url la id
$id= $_GET['id'];
$sql_eliminar = 'DELETE FROM colores WHERE id=?';

$sentencia_eliminar = $pdo->prepare($sql_eliminar);
$sentencia_eliminar->execute(array($id));


// cerramos conexion base de datos y sentencia_eliminar
$pdo=null;
$sentencia_eliminar=null;

header('location:index.php');
