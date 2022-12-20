<?php include("template/cabecera.php") ?>
<?php 
include("admin/config/db.php");

$sentenciaSQL= $conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listaLibros=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>
<?php foreach ($listaLibros as $libro) {
  
 ?>
	<div class="col-md-4 mt-3 ">
	<div class="card" style="width: 18rem;">
  <img style="height: 360px; width: auto;" src="./images/<?php echo $libro['imagen']; ?>" class="card-img-top" alt="...">
  <div class="card-body">
  	<h4 class="card-title"><?php echo $libro['nombre']; ?></h4>
  </div>
  <div class="badge text-bg-light" >
  		<?php echo $libro['datos']; ?>
  	</div>
	</div>
</div>
<?php 
}
?>













<?php include("template/pie.php") ?>