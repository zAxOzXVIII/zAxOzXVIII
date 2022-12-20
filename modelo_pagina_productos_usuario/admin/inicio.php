<?php 
include("template/cabecera.php"); 
?>

			<div class="col-md-12 mt-5">
				<div class="p-5 mb-4 bg-light rounded-3">
      			<div class="container-fluid py-5">
        			<h1 class="display-5 fw-bold"><?php echo "Bienvenido ".$user['name'] ?></h1>
        			<p class="col-md-8 fs-4">Vamos a administrar nuestro contendio en el sitio web</p>
        			<a href="sections/productos.php" class="btn btn-primary btn-lg" role="button">Comenzemos</a>
     			 </div>
    			</div>
			</div>


<?php include("template/pie.php") ?>