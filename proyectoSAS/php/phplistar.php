<?php
$sesion = new Session();
$usuario = new Usuario();
$usuario = $sesion->getUser();
$ss = $usuario->getSs();
$dni = $usuario->getDni();
$carpeta = $usuario->getDirectorio();

if ($ss != null) {
    if (is_dir($carpeta)) {
        $archivos = scandir($carpeta);
        for ($index = 2; $index < count($archivos); $index++) {
            echo "<li><a href=leer.php?imagen=$carpeta/$archivos[$index] >"
                    ."$archivos[$index]</a></li>";
        }
    }
}

