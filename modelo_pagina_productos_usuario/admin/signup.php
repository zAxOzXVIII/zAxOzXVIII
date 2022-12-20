<?php 
require('config/db.php');

if(!empty($_POST['usuario']) && !empty($_POST['password'])){
	$sql = ('INSERT INTO registro (name,password) VALUES (:usuario , :password)');
	$stmt = $conexion->prepare($sql);
	$stmt->bindParam(':usuario',$_POST['usuario']);
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$stmt->bindParam(':password',$password);
	if($stmt->execute()){
		$message= "Se ha registrado con exito";
	}else{ $message="Ha ocurrido un error...";}

}


?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Administrador del Sitio Web</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/workbench.css">
</head>
<body>
	
	<div class="container">
		<div class="row">
			


			<div class="col-md-4 mx-auto mt-5">
				<div class="card" style="width: 18rem;">
  					<div class="card-header">
    					Registro
  					</div>
  					<div class="card-body">
  						<?php if(isset($message)){ ?>
  						<div class="alert alert-danger" role="alert">
  							<?php echo $message; ?>
  						</div>



  						<?php } ?>
  						<form method="POST" >
  						<div class="mb-3">
   						 <label  class="form-label" >Usuario</label>
   						 <input type="text" class="form-control" name="usuario" aria-describedby="emailHelp" placeholder="ejem=rojo243">
  						  <div id="emailHelp" class="form-text">Jamas compartimos tus datos con nadie.</div>
  						</div>
  						<div class="mb-3">
  						  <label  class="form-label">Contraseña</label>
  						  <input type="password" class="form-control" name="password" placeholder="ejem=azul_.3124">
  						</div>
  						
  						<button type="submit" class="btn btn-primary">Registrar</button>
              <a href="index.php" class="btn btn-secondary">Ir Login</a>
						</form>		
               
  					</div>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>