<?php 
	include_once 'conexion.php';
	
	if(isset($_POST['guardar'])){
		$nombre=$_POST['nombre'];
		$apellido_paterno=$_POST['apellido_materno'];
		$apellido_materno=$_POST['apellido_paterno'];
		$fecha_nacimiento=$_POST['fecha_nacimiento'];
		$curp=$_POST['curp'];

		if(!empty($nombre) && !empty($apellido_paterno) && !empty($apellido_materno) && !empty($fecha_nacimiento) && !empty($curp) ){
				$consulta_insert=$con->prepare('INSERT INTO personas(nombre,apellido_paterno,apellido_materno,fecha_nacimiento,curp) VALUES(:nombre,:apellido_paterno,:apellido_materno,:fecha_nacimiento,:curp)');
				$consulta_insert->execute(array(
					':nombre' =>$nombre,
					':apellido_paterno' =>$apellido_paterno,
					':apellido_materno' =>$apellido_materno,
					':fecha_nacimiento' =>$fecha_nacimiento,
					':curp' =>$curp
				));
				header('Location: index.php');
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}
	}


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nueva Persona</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>CRUD EN PHP CON MYSQL</h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="nombre" placeholder="Nombre" class="input__text">
				<input type="text" name="apellido_paterno" placeholder="Apellido paterno" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="apellido_materno" placeholder="Apellido materno" class="input__text">
				<input type="date" name="fecha_nacimiento" placeholder="Fecha nacimiento" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="curp" placeholder="curp" class="input__text">
			</div>
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>