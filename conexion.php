<?php 

// CONEXION COON PDO: NO importa el controlador que se uilice
// siempre se utilizara el nombre de la clase PDO

$link = 'mysql:host=localhost;dbname=yt_colores';
$usuario = 'root';
$pass = '';

try{

 $pdo = new PDO($link,$usuario,$pass);

 echo 'conectado';

 // foreach ($pdo->query('SELECT * FROM `colores` ') as $fila) {
 // 	print_r($fila);
 // }

}catch (PDOException $e){
	print "Error:" . $e->getMessage(). "<br/>";
    die();
}
