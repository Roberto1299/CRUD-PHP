<?php
	include_once 'conexion.php';

	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];

		$buscar_id=$con->prepare('SELECT * FROM personas WHERE id=:id LIMIT 1');
		$buscar_id->execute(array(
			':id'=>$id
		));
		$resultado=$buscar_id->fetch();
	}else{
		header('Location: index.php');
	}


	if(isset($_POST['guardar'])){
		$nombre=$_POST['nombre'];
		$apellido_paterno=$_POST['apellido_paterno'];
		$apellido_materno=$_POST['apellido_materno'];
		$fecha_nacimiento=$_POST['fecha_nacimiento'];
		$curp=$_POST['curp'];
		$id=(int) $_GET['id'];

		if(!empty($nombre) && !empty($apellido_paterno) && !empty($apellido_materno) && !empty($fecha_nacimiento) && !empty($curp) ){
				$consulta_update=$con->prepare(' UPDATE personas SET  
					nombre=:nombre,
					apellido_paterno=:apellido_paterno,
					apellido_materno=:apellido_materno,
					fecha_nacimiento=:fecha_nacimiento,
					curp=:curp
					WHERE id=:id;'
				);
				$consulta_update->execute(array(
					':nombre' =>$nombre,
					':apellido_paterno' =>$apellido_paterno,
					':apellido_materno' =>$apellido_materno,
					':fecha_nacimiento' =>$fecha_nacimiento,
					':curp' =>$curp,
					':id' =>$id
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
	<title>Editar Cliente</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>CRUD EN PHP CON MYSQL</h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="nombre" value="<?php if($resultado) echo $resultado['nombre']; ?>" class="input__text">
				<input type="text" name="apellido_paterno" value="<?php if($resultado) echo $resultado['apellido_paterno']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="apellido_materno" value="<?php if($resultado) echo $resultado['apellido_materno']; ?>" class="input__text">
				<input type="date" name="fecha_nacimiento" value="<?php if($resultado) echo $resultado['fecha_nacimiento']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="curp" value="<?php if($resultado) echo $resultado['curp']; ?>" class="input__text">
			</div>
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>