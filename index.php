<?php 

include_once 'conexion.php';
// echo 'desde archivo index';
// obtener todas las filas restantes de un conjunto de resultados
$sql_leer = 'SELECT * FROM colores';

$gsent = $pdo->prepare($sql_leer);
// se ejecuta
$gsent->execute();
 // se manda a un array con fecall
$resultado = $gsent->fetchAll();
// imprime un array
// var_dump($resultado);

// AGREGAR

if($_POST){
	// ojo validacion
	// color y descripn se toma de name en el form
	$color = $_POST['color'];
	$descripcion = $_POST['descripcion'];

	// mandar a base dato
	$sql_agregar = 'INSERT INTO colores (color,descripcion) VALUES (?,?) ';
	$sentencia_agregar = $pdo->prepare($sql_agregar);
	$sentencia_agregar->execute(array($color,$descripcion));

    // cerramos conexion base de datos y sentencia_agregar
     $sentencia_agregar = null;
     $pdo=null;
    // para rederigir a la index.php, carga de nuevo a pagina 
	header('location:index.php');
}

if ($_GET) {
	$id = $_GET['id'];

	$sql_unico = 'SELECT * FROM colores WHERE id=? ';
	$gsent_unico = $pdo->prepare($sql_unico);
	$gsent_unico->execute(array($id));
	$resultado_unico = $gsent_unico->fetch();

	// var_dump($resultado_unico);
}

 ?>

 <!DOCTYPE html>
<html>
<head>
	<title>bootstrap</title>
	<link rel="stylesheet" type="text/css" href="core/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="mi.css"> -->
	<link href="./core/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
</head>
<body class="bg-dark">

<div class="container mt-5">
	<div class="row ">
		<div class="col-md-6">
			<!-- foreach recorre array dejar : para dejar abierto y cierra en endforeach -->
			<?php foreach($resultado as $dato): ?>

			<div 
			class="alert alert-<?php echo $dato['color'] ?> text-uppercase" role="alert">
		     <?php echo $dato['color'] ?>
		     -
		     <?php echo $dato['descripcion'] ?>
             
             <a href="eliminar.php?id=<?php echo $dato['id'] ?>" class="float-right ml-3">
             	<i class="far fa-trash-alt"></i>
             </a>

		     <a href="index.php?id=<?php echo $dato['id'] ?>" class="float-right">
		         <i class="fas fa-pencil-alt"></i>
		     </a>
	        </div>
	        <?php endforeach ?>

		</div>

		<div class="col-md-6">
			<!-- detectar no existe un metodo get  -->
			<?php if(!$_GET): ?>
			<h2>AGREGAR ELEMENTOS</h2>
			<form method="POST">
				<input type="text" class="form-control" name="color" placeholder="Nombre del color">
				<input type="text" class="form-control mt-3" name="descripcion" placeholder="Descripcion">
				<button class="btn btn-primary mt-3">Agregar</button>
			</form>
		     <?php endif ?>

		     <?php if($_GET): ?>
			<h2>EDITAR ELEMENTOS</h2>
			<form method="GET" action="editar.php">
				<input type="text" class="form-control" name="color"
				value="<?php echo $resultado_unico['color'] ?>">
				<input type="text" class="form-control mt-3" name="descripcion"
				value="<?php echo $resultado_unico['descripcion'] ?>"  >
				<input type="hidden" name="id" 
				value=" <?php echo $resultado_unico['id'] ?>">
				<button class="btn btn-primary mt-3">Agregar</button>
			</form>
		     <?php endif ?>
		</div>
	</div>
	
	
</div>

<!-- SCRIP -->
<!-- <script src="core/js/jquery-3.3.1.slim.min.js" type="text/javascript"></script> -->
<script src="core/js/bootstrap.min.js"></script>
<script src="core/js/popper.min.js"></script>
<script src="core/fontawesome-free/css/fontawesome.min.css"></script>

</body>
</html>

<?php 

$pdo=null;
$gsent=null;

 ?>