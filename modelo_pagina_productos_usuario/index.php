<?php include("template/cabecera.php") ?>

	<div class="container py-4">
    <header class="pb-3 mb-4 border-bottom bg-light rounded-3">
      <a class="d-flex align-items-center text-dark text-decoration-none">
        <span class="p-5 text-center fs-1 fw-bold">Bienvenido al Sitio Web</span>
      </a>
    </header>

    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class=" fw-bold">Que Hacemos</h1>
        <p class="col-md-8 fs-4">
        <button class="btn btn-primary btn-lg" type="button" data-bs-toggle="collapse" data-bs-target="#info" aria-expanded="false" aria-controls="info">Informacion</button>
        </p>
        <div>
          <div class="collapse collapse-horizontal" id="info">
            <div class="card card-body" style="width: 300px;">
              Contenido solo para informar al usuario sobre la empresa/This content was created only to inform about of the company.
           </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row align-items-md-stretch">
      <div class="col-md-6">
        <div class="h-100 p-5 text-bg-dark rounded-3">
          <h2>Contactanos</h2>
          <p></p>
          <a href="nosotros.php" class="btn btn-outline-light">Enlace</a>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="Javascript/bootstrap.js"></script>
<?php include("template/pie.php"); ?>