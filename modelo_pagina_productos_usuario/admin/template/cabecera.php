<?php
require('C:/xampp/htdocs/PHP/primer_test_php_pagina_curso_3hrs/admin/config/db.php');
session_start();
if(isset($_SESSION['user_id'])){
  $records = $conexion->prepare("SELECT id_pk,name,password FROM registro WHERE id_pk=:id");
  $records->bindParam(':id',$_SESSION['user_id']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $user = null;

  if(count($results)>0){
    $user = $results;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/workbench.css">
</head>
<body>

<?php 
  $url="http://".$_SERVER['HTTP_HOST']."/PHP/primer_test_php_pagina_curso_3hrs"
?>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #414141">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Administrador</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?php echo $url;?>/admin/inicio.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $url;?>/admin/sections/productos.php">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $url;?>/admin/sections/cerrar.php">Cerrar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $url;?>">Ver sitio web</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
	<div class="container">
		<div class="row">