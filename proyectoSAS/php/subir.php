<?php
require '../clases/AutoCarga.php';

$archivo = $_FILES["imagen"];
$sesion = new Session();
//evita que cree carpetas sino has enviado ningún archivo

$ss = Request::post("id_us");
$dni = Request::post("dni");
$carpeta = '../../../../SAS/'.$ss;
$usuario = new Usuario($dni,$ss,$carpeta);
$valor = 0;
$sesion->set("archivosSubidos", $valor);
$valor1 = 0;
$sesion->set("archivosTotales", $valor1);
$sesion->setUser($usuario);
if($archivo == null){
   $sesion->sendRedirect("user.php");
}
$fichero = new UploadFileArchivos($archivo,$ss);
$carpeta= $fichero->getDestino().$ss;
$usuario->setDirectorio($carpeta);

$valor = $fichero->getCantidadArchivos();
$sesion->set("archivosSubidos", $valor);
$sesion->setUser($usuario);
$valor1 = $fichero->getCantidadArchivos();
$sesion->set("archivosTotales", $valor1);

//sino esta la carpeta la creo
if(!is_dir($carpeta)){
    mkdir($carpeta.'/', 0777,true);
}
$fichero->upload();
$sesion->sendRedirect("user.php");
