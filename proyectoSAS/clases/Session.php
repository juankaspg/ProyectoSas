<?php

class Session {
    //Es un array Sesion
    private static $iniciada = false;
    
    function __construct($nombre="null") {
        if(!self::$iniciada) {
            //le pongo el nombre de sesión para poder distinguir sesiones
            //de distinto tipo
            if($nombre != null){
                session_name($nombre);
            }
            session_start();
            $this->_control();
            self::$iniciada = true;
        }
    }
    
    private function _control(){
        $ip = $this->get("_ip");
        $cliente = $this->get("_cliente");
        if($ip ==null && $cliente == null){
            $this->set($ip, Server::getClientAddres());
            $this->set($cliente, Server::getUserAgent());
        }else{
            if($ip != Server::getClientAddres() && $cliente!=Server::getUserAgent()){
                $this->destroy();
            }
        }
    }
    
    function isLogged(){
        return $this->getUser() != null;
    }
    
    function get($nombre){
        if(isset($_SESSION[$nombre])){
            return $_SESSION[$nombre];
        }
        return null;
    }
    
    function getUser(){
        return $this->get("_usuario");
    }
    
    function set($nombre,$valor){
        $_SESSION[$nombre] = $valor;
    }
    
    function setUser(Usuario $usuario){
        $this->set("_usuario", $usuario);
    }
    
    function delete($nombre){
        if(isset($_SESSION[$nombre])){
            unset($_SESSION["nombre"]);
        }
        return null;
    }
    
    function destroy(){
        session_destroy();
    }
    //Me envia a la página origen. Me envia un exit si quiero que se salga
    //99% de las veces quiero salir de aquí
    function sendRedirect($destino="login.php",$final = true){
        header("Location:$destino");
        if($final===true)
            exit ();
    }

}
