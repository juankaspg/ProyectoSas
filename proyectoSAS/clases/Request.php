<?php

class Request {
    
    /*Se comenta lo anterior y se utiliza readCarmelo para leer bien los datos
    y se le pasa el indice para que el gestione el metodo de lectura     */
    static function get($nombre,$filter = true,$indice = null){
        if(isset($_GET[$nombre])){
            return self::readCarmelo($_GET[$nombre],$filter,$indice);
            /*if(is_array($nombre)){
                if($indice === null){
                    $array = array();
                    foreach ($_GET[$nombre] as $value) {
                        $array[] = self::clean($value);
                    }
                    return $array;
                }else{
                    if(isset($_GET[$nombre][$indice]))
                        return self::clean ($_GET[$nombre][$indice]);
                }
            }else{
                return self::clean($_GET[$nombre]);
            }*/
        }
        return null;
    }
    /*Igual que el metodo de arriba*/
    static function post($nombre,$filter = true,$indice = null){
        if(isset($_POST[$nombre])){
            return self::readCarmelo($_POST[$nombre],$filter,$indice);
            /*
            if(is_array($nombre)){
                if($indice === null){
                    $array = array();
                    foreach ($_POST[$nombre] as $value) {
                        $array[] = self::clean($value);
                    }
                    return $array;
                }else{
                    if(isset($_POST[$nombre][$indice]))
                        return self::clean ($_POST[$nombre][$indice]);
                }
            }else{
                return self::clean($_POST[$nombre]);
            }*/
        }
        return null;
    }
    
    /*añadimos el parametro de indice para terminar de enlazar los metodos
    salvamos el valor     */
    static function req($nombre,$indice = null){
        $valor = self::post($nombre);
        if($valor !== null)   //Si el metodo usadso en mi formulario es post entonces compruebo que la 
                                                            //variable se haya mandado en el post y no el el get
            return $valor;                     //Si viene por post, se extrae de post
        return self::get($nombre,$indice);                          //Si se mando por el get en vez de por el post, entonces se extrae por get
    }
    
    /*  ESTE METODO ESTA REGULAR COMPROAR QUE VIENE LA ARIABLE NO EL METODO DE ENVIO DEL FORMULARIO
    static function readArray($nombre,$indice=null){
        if(Server::isPost() && self::post($nombre)!=null){
            if($indice!=null){
                return $_POST[$nombre][$indice];
            }else{
                return $_POST[$nombre];
            }
        }else{
            if(isset($_GET[$nombre])){
                if($indice!=null)
                    return $_GET[$nombre][$indice];
                return $_GET[$nombre];
            }
        }
    }
    
    static function elements($nombre){
        if(Server::isPost() && self::post($nombre)!=null){
            return count($_POST[$nombre]);
        }else{
            return count($_GET[$nombre]);
        }
    }
    */
    private static function clean($valor,$filter){//para filtrar y limpiar valores
        if($filter===true)
            return htmlspecialchars($valor);
        return trim($valor);
    }
/*
    static function readArrayCarmelo($nombre,$indice=null){
        if(isset($_GET[$nombre])){
            if($indice === null){
                $array = array();
                foreach ($_GET[$nombre] as $value) {
                    $array[] = self::clean($value);
                }
                return $array;
            }else{
                if(isset($_GET[$nombre][$indice]))
                    return self::clean ($_GET[$nombre][$indice]);
            }
        }
        return null;
    }
    */
    
    
    /*Pegamos las lineas del metodo get en el metodo readArray y lo renombramos
    y lo privatizamos y cambiamos la variable $nombre a $ parametro
    a este metodo llegua $_GET[nombre] o $_POST[nombre] de esta manera podemos 
     escribir $parametro en vez de $_GET[parametro] porque nos llega directamente
     *  el array   */
    private static function readCarmelo($parametro,$filter = true,$indice=null){
        if(is_array($parametro)){
            if($indice === null){
                $array = array();
                foreach ($parametro as $value) {
                    $array[] = self::clean($value,$filter);
                }
                return $array;
            }else{
                if(isset($parametro[$indice]))
                    return self::clean ($parametro[$indice],$filter);
            }
        }else{
            return self::clean($parametro,$filter);
        }
    }
    
}