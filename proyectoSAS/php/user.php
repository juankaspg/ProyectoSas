<?php
    require '../clases/AutoCarga.php';
    $sesion = new Session();
    $usuario = new Usuario();
    $usuario = $sesion->getUser();
    $ss = $usuario->getSs();
    $dni = $usuario->getDni();
    $archivosSubidos = $sesion->get("archivosSubidos");
    $archivosTotales = $sesion->get("archivosTotales");
    
    
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>El Usuario de Seguridad Social &nbsp;<?php echo $ss ?></h1>
        <h1>Dni : &nbsp;&nbsp;<?php echo $dni ?> </h1>
        <h1>Archivos subidos &nbsp;&nbsp;<?php echo $archivosSubidos.'/'.
                $archivosTotales ?> </h1>
        <ul>
        <?php
            include 'phplistar.php';
        ?>
        </ul>
        <p><a href="phplogout.php">Cierra Sesion</a></p>
    </body>
</html>
