<?php
require '../clases/AutoCarga.php';
//cojo la imagen del enlace <a>
$imagen = Request::get("imagen");
$trozos =  pathinfo($imagen);
$extension = $trozos ["extension"];
if($extension =="jpg"){
    header('Content-type: image/jpg');
}elseif ($extension =="gif"){
    header('Content-type: image/gif');
}
readfile($imagen);