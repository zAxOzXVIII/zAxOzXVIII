<?php include("../template/cabecera.php")?>
<?php 

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtDatos=(isset($_POST['txtDatos']))?$_POST['txtDatos']:"";
$txtFile=(isset($_FILES['txtFile']['name']))?$_FILES['txtFile']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/db.php");

switch ($accion) {
	case "Agregar":
		$sentenciaSQL= $conexion->prepare("INSERT INTO libros (nombre,imagen,datos) VALUES (:nombre, :imagen, :datos);");
		$sentenciaSQL->bindParam(':nombre',$txtNombre);

		$fecha= new DateTime();
		$nombreArchivo=($txtFile!="")?$fecha->getTimestamp()."_".$_FILES["txtFile"]["name"]:"imagen.jpg";
		$tmpImagen=$_FILES["txtFile"]["tmp_name"];

		if($tmpImagen!=""){

			move_uploaded_file($tmpImagen, "../../images/".$nombreArchivo);
		}
		$sentenciaSQL->bindParam(':datos',$txtDatos);
		$sentenciaSQL->bindParam(':imagen',$txtFile);
		$sentenciaSQL->execute();
		header("Location:productos.php");

		break;
	case "Modificar":

		$sentenciaSQL= $conexion->prepare("UPDATE libros SET nombre=:nombre,datos=:datos WHERE id=:id");
		$sentenciaSQL->bindParam(':nombre',$txtNombre);
		$sentenciaSQL->bindParam(':datos',$txtDatos);
		$sentenciaSQL->bindParam(':id',$txtID);
		$sentenciaSQL->execute();



		if($txtFile!=""){
			$fecha= new DateTime();
			$nombreArchivo=($txtFile!="")?$fecha->getTimestamp()."_".$_FILES["txtFile"]["name"]:"imagen.jpg";

			$tmpImagen=$_FILES["txtFile"]["tmp_name"];
				move_uploaded_file($tmpImagen, "../../images/".$nombreArchivo);

			$sentenciaSQL= $conexion->prepare("SELECT imagen FROM libros WHERE id=:id");
				$sentenciaSQL->bindParam(':id',$txtID);
				$sentenciaSQL->execute();
				$libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
				if( isset($libro["imagen"]) && ($libro["imagen"]!="imagen.jpg") ){
					if (file_exists("../../images/".$libro["imagen"])) {
						unlink("../../images/".$libro["imagen"]);
						
					}
					
				}

			$sentenciaSQL= $conexion->prepare("UPDATE libros SET imagen=:imagen WHERE id=:id");
			$sentenciaSQL->bindParam(':imagen',$nombreArchivo);
			$sentenciaSQL->bindParam(':id',$txtID);
			$sentenciaSQL->execute();
		}
		//echo "Presionado boton Modificar";
		header("Location:productos.php");
		break;
	case "Cancelar":
		header("Location:productos.php");
		break;

	case "Seleccionar":
		$sentenciaSQL= $conexion->prepare("SELECT * FROM libros WHERE id=:id");
		$sentenciaSQL->bindParam(':id',$txtID);
		$sentenciaSQL->execute();
		$libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
		//echo "Presionado boton Seleccionar";
		$txtNombre=$libro['nombre'];
		$txtFile=$libro['imagen'];
		$txtDatos=$libro['datos'];
		break;
		
	case "Borrar":
		$sentenciaSQL= $conexion->prepare("SELECT imagen FROM libros WHERE id=:id");
		$sentenciaSQL->bindParam(':id',$txtID);
		$sentenciaSQL->execute();
		$libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

		if( isset($libro['imagen']) && ($libro['imagen']!="imagen.jpg") ){
			if (file_exists("../../images/".$libro['imagen'])) {
				unlink("../../images/".$libro['imagen']);
			}
			
		}
		
		$sentenciaSQL= $conexion->prepare("DELETE FROM libros WHERE id=:id");
		$sentenciaSQL->bindParam(':id',$txtID);
		$sentenciaSQL->execute(); 
		header("Location:productos.php"); 
		break;
	default:
	break;
}
$sentenciaSQL= $conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listaLibros=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="col-md-5">

	<div class="card mt-5">
		<div class="card-header">
			<h5>Datos del libro</h5>
		</div>
		<div class="card-body">
			<form method="POST" enctype="multipart/form-data">
 			 	<div class="mb-3">
  			  		<label for="txtID" class="form-label">ID</label>
  			  		<input type="text" required="" readonly="" class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
  		  
  				</div>
  				<div class="mb-3">
  			  		<label for="txtNombre" class="form-label">Nombre</label>
  			 		 <input type="text" required="" class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre del libro">
  				</div>
  				<div class="mb-3">
  			  		<label for="txtDatos" class="form-label">Datos</label>
  			 		 <input type="text" required="" class="form-control" value="<?php echo $txtDatos;?>" name="txtDatos" id="txtDatos" placeholder="Informacion del libro">
  				</div>
  				<div class="mb-3">
  			  		<label for="txtFile" class="form-label" >Imagen</label>

  			  		<?php echo $txtFile; ?>
  			  		<?php 
  			  		if ($txtFile!="") {
  			  		?>

  			  		<img class="img-thumbnail rounded" src="../../images/<?php echo $txtFile;  ?>" alt="" width="50" srcset="">

  			  		<?php } ?>
  			  		<input type="file" class="form-control"  name="txtFile" id="txtFile">
  			  
  				</div>
  			
  				<div class="btn-group" role="group" aria-label="">
  					<button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>

  					<button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning">Modificar</button>

  					<button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
  				</div>

			</form>
		</div>
	</div>

	
</div>
<div class="col-md-7">
	
	<table class="table table-light table-striped table-hover table-bordered mt-5">
  	<thead>
    	<tr>
     	 <th scope="col">ID</th>
     	 <th scope="col">Nombre</th>
     	 <th scope="col">Imagen</th>
     	 <th scope="col">Acciones</th>
   	 </tr>
  	</thead>
 	 <tbody>
 	 	<?php
 	 	foreach ($listaLibros as $libro) {
 	 	?>
    	<tr>
     	 <th scope="row"><?php echo $libro['id'];  ?></th>
     	 <td><?php echo $libro['nombre'];  ?></td>
     	 <td>

     	 	<img class="img-thumbnail rounded" src="../../images/<?php echo $libro['imagen'];  ?>" alt="" width="50" srcset="">

     	 </td>

      	<td>
      	<form action="" method="POST">
      		
      		<input type="hidden" name="txtID" id="txtID" value="<?php echo $libro['id'];  ?>"/>

      		<input type="submit" name="accion" id="" value="Seleccionar" class="btn btn-primary"/>
      		<input type="submit" name="accion" id="" value="Borrar" class="btn btn-danger"/>

      	</form>

      	</td>

    	</tr>
    	<?php } ?>
  	</tbody>
	</table>

</div>

<?php include("../template/pie.php")?>