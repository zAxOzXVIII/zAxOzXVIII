<?php
$host = "localhost";
$bd="sitio";
$usuario="root";
$password="";

try{
	$conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$password);
	if($conexion){
		
	}
}catch(Exception $ex){
	echo $ex->getMessage();
}
?>
